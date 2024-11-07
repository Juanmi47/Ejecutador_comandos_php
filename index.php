<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *"); 

    require_once __DIR__ . '/CommandController.php';

    $input = json_decode(file_get_contents("php://input"), true);
    if (!isset($input['command'])) {
        echo json_encode(['error' => 'Comando no especificado']);
        http_response_code(400);
        exit;
    }

    $controller = new CommandController();
    $response = $controller->executeCommand($input['command']);
    echo json_encode($response);
} else {

    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejecutor de Comandos</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <h1>Ejecutor de Comandos</h1>
        <input type="text" id="commandInput" placeholder="Ingresa un comando" />
        <button onclick="executeCommand()">Ejecutar</button>

        <h2>Resultado:</h2>
        <pre id="output"></pre>

        <script>
            function executeCommand() {
                const command = document.getElementById('commandInput').value;

                fetch(window.location.href, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ command: command })
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('output').innerText = data.output ? data.output.join('\n') : data.error;
                })
                .catch(error => {
                    document.getElementById('output').innerText = 'Error: ' + error;
                });
            }
        </script>
    </body>
    </html>
    <?php
}
