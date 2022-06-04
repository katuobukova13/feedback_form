<?php

namespace App\Http\Controllers;

use App\SaveMethods\DBStorage;
use App\SaveMethods\FileStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    public array $errorMessage;

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
            if ($validator->messages()->has('name')) {
                $errorMessage[] = "Имя должно быть заполнено";
            }
            if ($validator->messages()->has('phone')) {
                $errorMessage[] = "Телефон должен содержать 11 цифр";
            }
            if ($validator->messages()->has('text')) {
                $errorMessage[] = "Сообщение не заполнено";
            }
            return [
                "status" => false,
                "error" => $errorMessage
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
