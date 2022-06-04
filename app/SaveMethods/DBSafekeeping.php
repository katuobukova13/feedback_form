<?php

namespace App\SaveMethods;

use App\Models\Feedback;

class DBSafekeeping implements Storage
{
    public function save(array $formData): bool
    {
        $feedback = Feedback::create([
            "name" => $formData['name'],
            "phone" => $formData['phone'],
            "text" => $formData['text'],
        ]);

        return $feedback->wasRecentlyCreated;
    }
}
