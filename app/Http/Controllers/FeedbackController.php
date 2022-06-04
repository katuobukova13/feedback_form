<?php

namespace App\Http\Controllers;

use App\SaveMethods\DBStorage;
use App\SaveMethods\FileStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    /**
     * @param Request $request
     * @return array
     */
    public function store(Request $request): array
    {
        $validator = Validator::make(
            $request->all(),
            [
                "name" => ["required", "max:100"],
                "phone" => ["required", "digits:11"],
                "text" => ["required", "max: 2500"],
            ]
        );

        if ($validator->fails()) {
            return [
                "status" => false,
                "error" => $validator->messages()
            ];
        }

        $formData = [
            "name" => $request->name,
            "phone" => $request->phone,
            "text" => $request->text,
        ];

        $feedbackFile = App::make(FileStorage::class)->save($formData);

        $feedbackDB = App::make(DBStorage::class)->save($formData);

        if ($feedbackDB && $feedbackFile) {
            return [
                "status" => true,
                "feedback" => $formData
            ];
        } else
            return [
                "status" => false,
            ];
    }
}
