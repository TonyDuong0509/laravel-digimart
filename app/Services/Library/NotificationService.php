<?php

namespace App\Services\Library;
use Flasher\Noty\Prime\NotyInterface;

class NotificationService
{
    private static $createMessage = 'Created Successfully';
    private static $updateMessage = 'Updated Successfully';
    private static $deleteMessage = 'Deleted Successfully';
    private static $errorMessage = 'Something Went Wrong';

    static function CREATED($message = null)
    {
        noty()->success($message ?? self::$createMessage);
    }

    static function UPDATED($message = null)
    {
        noty()->success($message ?? self::$updateMessage);
    }

    static function DELETED($message = null)
    {
        noty()->success($message ?? self::$deleteMessage);
    }

    static function ERROR($message = null)
    {
        noty()->error($message ?? self::$errorMessage);
    }
}
