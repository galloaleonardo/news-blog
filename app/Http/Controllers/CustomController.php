<?php

namespace App\Http\Controllers;

class CustomController extends Controller
{

    const SUCCESS = 'success';
    const ERROR = 'warning';

    const ERROR_CREATE_MESSAGE = 'admin.error_creating';
    const ERROR_UPDATE_MESSAGE = 'admin.error_updating';
    const ERROR_DELETE_MESSAGE = 'admin.error_deleting';

    const SUCCESS_CREATE_MESSAGE = 'admin.created_successfully';
    const SUCCESS_UPDATE_MESSAGE = 'admin.updated_successfully';
    const SUCCESS_DELETE_MESSAGE = 'admin.deleted_successfully';

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
