<?php

namespace App\Http\Controllers;

class CustomController extends Controller
{

    const SUCCESS = 'success';
    const ERROR = 'warning';

    public static function responseRoute(
        string $status,
        string $routeName,
        string|array $statusMessage,
        string $objectName
    ) {

        if (is_array($statusMessage)) {
            $fullMessage = trans($statusMessage[0], ['object' => trans($objectName)]) . '. ' . trans($statusMessage[1]);
        } else {
            $fullMessage = trans($statusMessage, ['object' => trans($objectName)]);
        }

        return redirect(route($routeName))->with($status, $fullMessage);
    }
}
