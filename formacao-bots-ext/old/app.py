from flask import Flask, request, jsonify
from flask_cors import CORS
import requests
import logging
import json
# from db import salvar_conversa

app = Flask(__name__)
CORS(app)
app.config['CORS_HEADERS'] = 'Content-Type'
# Debug
# logging.basicConfig(level=logging.DEBUG)
# logging.getLogger('flask_cors').level = logging.DEBUG
logging.basicConfig(filename='app.log',                    
                    level=logging.DEBUG)

# URL do bot
URL_BOT = 'http://acs-assist-bot-cad-form.nia.hm.bb.com.br/acs/llms/agent'


@app.route('/chat', methods=['POST'])
# @cross_origin()
def chat():
    data = request.json
    app.logger.debug(f'Received data: {data}')

    # Verifica se o input está presente na requisição
    if 'input' not in data:
        app.logger.error('Input ausente na requisição')
        return jsonify({"error": "O input do usuário é obrigatório"}), 400

    input_usuario = data['input']
    contexto = data.get('context', {})

    # Payload
    payload = {
        "data": {
            "input": input_usuario,
            "context": contexto
        }
    }

    # Log do payload que está sendo enviado
    app.logger.debug(f'Dados enviados para o bot: {payload}')

    try:
        # Enviar a solicitação para a API externa do chatbot
        response = requests.post(URL_BOT, json=payload, headers={'Content-Type': 'application/json'})
        response.raise_for_status()
        response_data = response.json()

        # Log do payload que está sendo recebido
        app.logger.debug(f'Resposta do bot: {response_data}')
        
        # Extrair a resposta do bot e o contexto
        resposta_bot = response_data.get('data', {}).get('output', {}).get('text', ['Desculpe, não entendi.'])[0]
        contexto = response_data.get('data', {}).get('context', {})

        # # Salvar conversa no banco de dados
        # conversation_id = contexto.get("conversation_id")
        # user_id = contexto.get("metadata", {}).get("user_id")
        # salvar_conversa(conversation_id, user_id, input_usuario, resposta_bot, contexto)

    except requests.exceptions.RequestException as e:
        app.logger.error(f'Erro de comunicação com o bot: {e}')
        resposta_bot = 'Desculpe, não estou conseguindo consultar minha base de conhecimento agora'
        contexto = data.get('context', {})
    
    # Resposta JSON para enviar de volta ao cliente
    response = {
        "input": input_usuario,
        "output": {"text": resposta_bot},
        "context": contexto
    }
    app.logger.debug(f'Resposta para o cliente: {response}')
    return jsonify(response)

if __name__ == '__main__':
    app.run(debug=True)
