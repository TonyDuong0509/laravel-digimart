<?php

namespace App\Services\Library;
use Flasher\Noty\Prime\NotyInterface;

class NotificationService
{
    static function CREATED($message = null)
    {
        noty()->success($message ?? __('Created Successfully'));
    }

    static function UPDATED($message = null)
    {
        noty()->success($message ?? __('Updated Successfully'));
    }

    static function DELETED($message = null)
    {
        noty()->success($message ?? __('Deleted Successfully'));
    }

    static function ERROR($message = null)
    {
        noty()->error($message ?? __('Something Went Wrong'));
    }
}
