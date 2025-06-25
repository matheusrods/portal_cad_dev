-- cria (ou garante) o usuário para conexão remota
CREATE USER IF NOT EXISTS 'cad_user'@'%' 
  IDENTIFIED WITH mysql_native_password BY '12345';
GRANT ALL PRIVILEGES ON cad.* TO 'cad_user'@'%';
FLUSH PRIVILEGES;
