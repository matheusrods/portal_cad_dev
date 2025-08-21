# Portal CAD — Stack PHP + MySQL (Docker)

Projeto PHP 8.1 + Apache com MySQL 8 em Docker.  
Inclui criação de bancos/tabelas via scripts em `initdb.d` e **restauração automática de dados** a partir de backups `.gz` por tabela.

## Requisitos

- Docker e Docker Compose v2
- Portas livres: **80/443** (app) e **3306** (MySQL)

## Estrutura importante

```
docker/
├─ docker-compose.yml
├─ Dockerfile                  # imagem do web (php:8.1-apache)
├─ mysql/
│  ├─ Dockerfile.db            # imagem do MySQL 8 (custom)
│  └─ conf.d/
│     ├─ my.cnf                # configs (utf8mb4, etc.)
│     └─ initdb.d/             # scripts executados SOMENTE no 1º start do volume
│        ├─ 00-*.sql           # criação de DBs e tabelas (ordenados por prefixo)
│        ├─ 24-ux_struct.sql   # (exemplo) demais estruturas
│        ├─ 90-restore-table-data.sh  # restaura dados por tabela
│        └─ backups/
│           ├─ cad/
│           │  ├─ desenvolvedores.gz
│           │  ├─ desenvolvedores_2025-08-20.gz
│           │  └─ ...
│           ├─ solicitacoes/
│           │  ├─ solicitacoes_2025-08-20.gz
│           │  └─ ...
│           └─ ...             # uma pasta POR banco
```

> **Importante:** Os scripts de `initdb.d` executam **apenas** quando o volume do MySQL está **vazio** (primeiro `up` com `db_data` novo).

---

## Subir o ambiente

Do diretório `docker/`:

```bash
docker compose up --build
```

Acesse:
- App: http://localhost/
- MySQL: `localhost:3306`

Credenciais padrão (conforme `docker-compose.yml`):
- **host**: `db` (dentro do docker) / `127.0.0.1` (fora)
- **user**: `root`
- **pass**: `rootpassword`
- **db**: `cad` (e outros criados pelos seus scripts)

No container **web**, o PHP lê variáveis de ambiente:

```yaml
environment:
  DB_HOST: db
  DB_DATABASE: cad
  DB_USERNAME: root
  DB_PASSWORD: rootpassword
  SITE_ROOT: /var/www/html
  CHARSET: utf8mb4
```

Seu PHP deve mapear `$_SERVER['DB_HOST']`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` etc.

---

## Como funcionam os dados (restore por tabela)

O script `90-restore-table-data.sh` restaura **dados** para cada tabela já criada, buscando dumps `.gz` em:

```
mysql/conf.d/initdb.d/backups/<NOME_DO_BANCO>/
```

### Nomes aceitos dos arquivos
- **Preferencial:** `<tabela>.gz`
- Alternativo: `<tabela>_*.gz` (ex.: `tabela_2025-08-20.gz`)

> Ele seleciona o **mais recente** (ordem natural pelo nome) quando há múltiplos.

### O que o script faz automaticamente
- Ignora qualquer `SET ... sql_mode` nos dumps (incluindo `/*!...*/`).
- Converte datas zeradas (`'0000-00-00'` e `'0000-00-00 00:00:00[.000000]'`) para **`NULL`**.
- **Relaxamento de STRICT** só na sessão de import:
  - `SET SESSION sql_mode = REPLACE(@@SESSION.sql_mode, 'STRICT_TRANS_TABLES','');`
- Desliga e religa `FOREIGN_KEY_CHECKS`/`UNIQUE_CHECKS` durante o restore.
- Apenas **DML** é aplicado (INSERT/REPLACE/UPDATE/DELETE); DDL é ignorado.

### Executar restore manualmente (sem recriar volume)

Rodar para **todos os bancos** que têm pasta em `backups/`:

```bash
docker exec -it portal-dbcad bash /docker-entrypoint-initdb.d/90-restore-table-data.sh
```

Rodar **apenas um banco**:

```bash
docker exec -e DB_TARGET=solicitacoes -it portal-dbcad \
  bash /docker-entrypoint-initdb.d/90-restore-table-data.sh
```

---

## Zerar e recriar tudo (inclui re-execução dos .sql e restore)

Isso **apaga o volume** do MySQL:

```bash
docker compose down -v
docker compose up --build
```

---

## Dicas para preparar seus backups

- Coloque os `.gz` em `mysql/conf.d/initdb.d/backups/<banco>/`.
- Use **um arquivo por tabela**.
- Ex.: `backups/cad/desenvolvedores.gz` OU `backups/cad/desenvolvedores_2025-08-20.gz`
- Certifique-se que os dumps contêm **apenas DML** (INSERT/REPLACE/UPDATE/DELETE).  
  Se vierem com DDL (CREATE/DROP/ALTER), o script descarta, então não há problema.

---

## Troubleshooting

### “Por que meus .sql/.gz não rodam?”
- Lembre-se: `initdb.d` só roda no **primeiro start** do volume.  
  Para reexecutar tudo, faça `down -v` (apaga o volume) e `up --build`.

### `Variable 'sql_mode' can't be set to the value of 'NO_AUTO_CREATE_USER'`
- Seus arquivos de **estrutura** são ajustados na build para **remover** esse valor.
- Nos **dumps de dados**, o script também remove qualquer `SET ... sql_mode`.

### `Incorrect date value: '0000-00-00'`
- O script converte essas datas para `NULL`.  
  Se ainda ocorrer, verifique se o dump está comprimido corretamente (`.gz`) e se o nome da tabela confere.

### `Data too long for column ...`
- O script relaxa `STRICT_TRANS_TABLES` na sessão do restore, reduzindo esses erros.
- Se ainda falhar, o dado realmente excede o tamanho da coluna: ajuste o schema (ALTER TABLE) **ou** limpe o dump.

### “Permission denied” ao ler `backups/`
- Se estiver **montando** do host, garanta permissões legíveis:
  - diretórios: `chmod 755`
  - arquivos `.gz/.sql`: `chmod 644`

---

## Criar um usuário de app (opcional)

Se depois você **não quiser usar root** na aplicação:

Crie um init SQL (ex.: `mysql/conf.d/initdb.d/10-create-user.sql`):

```sql
CREATE USER IF NOT EXISTS 'app_user'@'%' IDENTIFIED BY '12345';
GRANT ALL PRIVILEGES ON cad.* TO 'app_user'@'%';
-- Repita GRANT para outros bancos, se necessário
FLUSH PRIVILEGES;
```

E no `docker-compose.yml` (serviço `web`):

```yaml
environment:
  DB_HOST: db
  DB_DATABASE: cad
  DB_USERNAME: app_user
  DB_PASSWORD: 12345
```

---

## Comandos úteis

Logs do MySQL (inclui execução dos scripts):

```bash
docker logs -f portal-dbcad
```

Entrar no MySQL client:

```bash
docker exec -it portal-dbcad mysql -uroot -prootpassword
```

Reexecutar apenas o restore:

```bash
docker exec -it portal-dbcad bash /docker-entrypoint-initdb.d/90-restore-table-data.sh
```

---

## Notas finais

- O **build do MySQL** aplica “higienizações” nos `.sql` de estrutura (remove `NO_AUTO_CREATE_USER`, `DEFINER` e ajusta `TEMPORARY` do script `home_struct`).
- O **restore** de dados é robusto contra `sql_mode`, datas zeradas e `STRICT`, mas **não** corrige incompatibilidades reais de esquema/tipos.
- PHP lê as variáveis via `$_SERVER[...]`; garanta que o nome (`DB_HOST`, `DB_DATABASE`, etc.) esteja idêntico ao do `docker-compose.yml`.
