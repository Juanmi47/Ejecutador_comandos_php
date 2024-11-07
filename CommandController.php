<?php

class CommandController {
    public function executeCommand($command) {

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