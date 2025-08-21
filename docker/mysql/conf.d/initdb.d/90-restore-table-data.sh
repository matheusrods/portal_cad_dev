#!/usr/bin/env bash
set -eE -o pipefail

# Restaura dados por tabela a partir de backups .gz
# /docker-entrypoint-initdb.d/backups/<db>/<tabela>.gz
# /docker-entrypoint-initdb.d/backups/<db>/<tabela>_*.gz

BK_ROOT="./backups"   # relativo a /docker-entrypoint-initdb.d

cd "$(dirname "${BASH_SOURCE[0]:-$0}")"
echo "[restore-data] initdb.d = $(pwd)"
echo "[restore-data] backups root = ${BK_ROOT}"

mysql_exec() { mysql -uroot -p"$MYSQL_ROOT_PASSWORD" "$@"; }

get_db_list() {
  if [[ -n "${DB_TARGET:-}" ]]; then
    printf '%s\n' "$DB_TARGET"
  else
    find "$BK_ROOT" -mindepth 1 -maxdepth 1 -type d -printf '%f\n' 2>/dev/null | sort -u
  fi
}

# Remove QUALQUER SET sql_mode, inclusive em comentários /*!...*/
drop_sql_mode_lines() {
  tr -d '\r' \
  | sed -E 's:/\*![0-9]{5}[[:space:]]+SET[[:space:]]+[^*]*\*/;?::Ig' \
  | grep -vi -E '^[[:space:]]*SET[[:space:]]+(SESSION|GLOBAL|@@[[:alnum:]_]+[[:space:]]*=|@@)?[[:space:]]*sql_mode'
}

# Converte datas zeradas para NULL (date/datetime/timestamp)
fix_zero_dates() {
  sed -E -e "s/'0000-00-00([[:space:]]+00:00:00([.]0{1,6})?)?'/NULL/gI"
}

# Emite SOMENTE DML (INSERT/REPLACE/UPDATE/DELETE) por blocos até o ';'
filter_dml_blocks() {
  awk '
    BEGIN{emit=0}
    /^[[:space:]]*(INSERT|REPLACE|UPDATE|DELETE)\b/i { emit=1 }
    emit { print }
    emit && /;[[:space:]]*$/ { emit=0 }
  '
}

table_exists() {
  local db="$1" tbl="$2"
  mysql_exec -N -B \
    -e "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema='${db}' AND table_name='${tbl}'" \
  | grep -q '^1$'
}

# Escolhe o melhor arquivo para a tabela dentro de backups/<db>/
latest_backup_for_table() {
  local db="$1" tbl="$2" dir="${BK_ROOT}/${db}"
  local files=()

  # Match EXATO: <tabela>.gz
  if [ -f "${dir}/${tbl}.gz" ]; then
    printf '%s\n' "${dir}/${tbl}.gz"
    return 0
  fi

  # Fallback: <tabela>_*.gz, garantindo prefixo == nome da tabela
  while IFS= read -r f; do
    base="$(basename "$f")"
    prefix="${base%%_*}"
    if [ "$prefix" = "$tbl" ]; then
      files+=( "$f" )
    fi
  done < <(compgen -G "${dir}/${tbl}_"'*.gz' || true)

  [ ${#files[@]} -eq 0 ] && return 1
  printf '%s\n' "${files[@]}" | sort -V | tail -n1
}

restore_table_from_gz() {
  local db="$1" tbl="$2" gz="$3"
  if [ ! -f "$gz" ]; then
    echo "[restore-data] (erro) arquivo não encontrado: $gz"
    return 0
  fi
  echo "[restore-data] ${db}.${tbl}  <=  ${gz##*/}"
  {
    cat <<'SQL'
SET @__old_sql_mode := @@SESSION.sql_mode;
SET SESSION sql_mode = REPLACE(@@SESSION.sql_mode,'STRICT_TRANS_TABLES','');
SET FOREIGN_KEY_CHECKS=0; SET UNIQUE_CHECKS=0;
SQL
    gzip -dc "$gz" \
      | drop_sql_mode_lines \
      | fix_zero_dates \
      | filter_dml_blocks
    cat <<'SQL'
SET UNIQUE_CHECKS=1; SET FOREIGN_KEY_CHECKS=1;
SET SESSION sql_mode = @__old_sql_mode;
SQL
  } | mysql_exec -D "$db"
}

main() {
  if [[ ! -d "$BK_ROOT" ]]; then
    echo "[restore-data] (aviso) backups/ não encontrado; nada a restaurar."
    return 0
  fi

  echo "[restore-data] subpastas de backups/:"
  find "$BK_ROOT" -mindepth 1 -maxdepth 1 -type d -printf '  - %f\n' | sed -n '1,200p' || true

  while IFS= read -r db; do
    [[ -z "$db" ]] && continue
    if ! mysql_exec -N -B -e "SHOW DATABASES LIKE '${db}'" | grep -qx "$db"; then
      echo "[restore-data] (info) DB '${db}' não existe ainda — pulando."
      continue
    fi

    echo "[restore-data] --- Banco: ${db} ---"
    echo "[restore-data] arquivos em ${BK_ROOT}/${db}:"
    ls -lah "${BK_ROOT}/${db}" | sed -n '1,120p' || true

    mapfile -t tables < <(mysql_exec -N -B -e "SHOW TABLES IN \`${db}\`;")
    (( ${#tables[@]} )) || { echo "[restore-data] (info) sem tabelas em ${db}; pulando."; continue; }

    for tbl in "${tables[@]}"; do
      table_exists "$db" "$tbl" || { echo "[restore-data] (skip) ${db}.${tbl} não existe."; continue; }

      if ! gz="$(latest_backup_for_table "$db" "$tbl")"; then
        echo "[restore-data] (sem backup) ${db}.${tbl} — procurar '${BK_ROOT}/${db}/${tbl}.gz' ou '${BK_ROOT}/${db}/${tbl}_*.gz'."
        continue
      fi

      restore_table_from_gz "$db" "$tbl" "$gz"
    done
  done < <(get_db_list)

  echo "[restore-data] Concluído."
}

main