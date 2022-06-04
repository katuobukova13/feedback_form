<?php

namespace App\SaveMethods;

class FileSafekeeping implements Storage
{
    public function save(array $formData): bool
    {
        $file = 'feedback.txt';
        $saveData = file_put_contents($file, [
            'Name: ' . $formData['name'] . PHP_EOL,
            'Phone: ' . $formData['phone'] . PHP_EOL,
            'Text: ' . $formData['text'] . PHP_EOL,
            PHP_EOL
        ], FILE_APPEND);

        return (bool)$saveData;
    }
}
