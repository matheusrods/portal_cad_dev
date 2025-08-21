#!/bin/bash
set -euo pipefail

# Sempre trabalhar dentro desta pasta (o entrypoint usa "source")
cd "$(dirname "${BASH_SOURCE[0]:-$0}")"

echo "[fix-sql] Pasta: $(pwd)"

# Normaliza quebras de linha (se estiver no Windows)
if command -v dos2unix >/dev/null 2>&1; then
  dos2unix *.sql >/dev/null 2>&1 || true
fi

# 1) Remover NO_AUTO_CREATE_USER de QUALQUER arquivo
for f in *.sql; do
  [ -f "$f" ] || continue
  sed -i -E "s/(SET sql_mode\s*=\s*')([^']*)NO_AUTO_CREATE_USER,?([^']*)'/\1\2\3'/g" "$f"
done

# 2) Remover DEFINER de procedures/functions em todos os arquivos
for f in *.sql; do
  [ -f "$f" ] || continue
  sed -i -E 's/CREATE DEFINER=`[^`]+`@`[^`]+`\s+(PROCEDURE|FUNCTION)/CREATE \1/g' "$f"
done

# 3) Desqualificar TABELAS TEMPORÁRIAS apenas no arquivo *home_struct.sql
HOME_SQL="$(ls -1 *home_struct.sql 2>/dev/null | head -n1 || true)"
if [ -n "${HOME_SQL:-}" ] && [ -f "$HOME_SQL" ]; then
  echo "[fix-sql] Ajustando temporárias em: $HOME_SQL"
  sed -i -E 's/\bDROP TEMPORARY TABLE IF EXISTS\s+report\.([A-Za-z0-9_]+)/DROP TEMPORARY TABLE IF EXISTS \1/g' "$HOME_SQL"
  sed -i -E 's/\bCREATE TEMPORARY TABLE\s+report\.([A-Za-z0-9_]+)\b/CREATE TEMPORARY TABLE \1/g' "$HOME_SQL"
  sed -i -E 's/\breport\.(interacoesPf|interacoesPfOntem|usuariosPf|usuariosPfOntem|conversasPf|conversasPfOntem|notaMediaPf|notaMediaPfOntem|totalRao|totalRaoOntem|totalAtivosSA|totalAtivosSAOntem|totalCdc|totalCdcOntem|totalAtivosEnviados|totalAtivosEnviadosOntem)\b/\1/g' "$HOME_SQL"
else
  echo "[fix-sql] *home_struct.sql não encontrado — pulando correções de temporárias"
fi

echo "[fix-sql] Correções aplicadas."
