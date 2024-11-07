<?php
// src/CommandController.php

class CommandController {
    public function executeCommand($command) {
        // Ejecuta el comando sin ningún filtrado
        $output = [];
        $returnVar = 0;
        exec($command, $output, $returnVar);

        return [
            'command' => $command,
            'output' => $output,
            'status' => $returnVar
        ];
    }
}