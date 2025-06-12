# import mysql.connector
import logging
import json

# Configurar a conexão com o banco de dados MySQL
db_config = {
    'user': 'seu_usuario',
    'password': 'sua_senha',
    'host': 'localhost',
    'database': 'chatbot_db'
}

def salvar_conversa(conversation_id, user_id, user_input, bot_response, context):
    try:
        # Estabelecer conexão com o banco de dados
        connection = mysql.connector.connect(**db_config)
        cursor = connection.cursor()

        # Inserir os dados na tabela log_conversas_bot
        query = ("INSERT INTO log_conversas_bot (conversation_id, user_id, input, resposta_bot, context) "
                 "VALUES (%s, %s, %s, %s, %s)")
        cursor.execute(query, (conversation_id, user_id, user_input, bot_response, json.dumps(context)))
        connection.commit()
        
        # Fechar o cursor e a conexão
        cursor.close()
        connection.close()
    except mysql.connector.Error as err:
        logging.error(f"Erro ao salvar a conversa no banco de dados: {err}")
