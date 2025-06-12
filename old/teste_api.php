<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Texto para API</title>
</head>
<body>
    <form id="apiForm">
        <label for="inputTexto">Texto:</label>
        <input type="text" id="inputTexto" name="inputTexto" placeholder="Insira um número de 1 a 200" required>
        <button type="submit">Enviar</button>
        <button id="limpar" type="reset">Limpar</button>
    </form>

    <div id="response">
        <p><strong>ID:</strong> <span id="responseContext"></span></p>
        <p><strong>Texto de resposta:</strong> <span id="responseText"></span></p>
        <p><strong>Complete:</strong> <span id="completeText"></span></p>
    </div>

    <script>
        document.getElementById('apiForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const inputText = document.getElementById('inputTexto').value;

            fetch('https://jsonplaceholder.typicode.com/todos/'+inputText)
            .then(response => response.json())
            .then(json => {
                document.getElementById('responseText').textContent = json.title;
                document.getElementById('responseContext').textContent = inputText;
                document.getElementById('completeText').textContent = json.completed;
            })
            .catch(error => console.error('Erro:', error));
        });
    </script>
</body>
</html>

<!-- 
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Texto para API</title>
</head>
<body>
    <form id="apiForm">
        <label for="inputText">Texto:</label>
        <input type="text" id="inputText" name="inputText" required>
        <button type="submit">Send</button>
    </form>

    <div id="response">
        <p><strong>Texto de resposta:</strong> <span id="responseText"></span></p>
        <p><strong>Contexto:</strong> <span id="responseContext"></span></p>
    </div>

    <script>
        document.getElementById('apiForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const inputText = document.getElementById('inputText').value;
            const data = {
                input: inputText,
                contexto: ''
            };

            fetch('https://jsonplaceholder.typicode.com/todos/1')
            .then(response => response.json())
            .then(json => console.log(json))
        });
    </script>
</body>
</html> -->