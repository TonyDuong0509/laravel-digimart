<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Mockery\Exception;

trait FileUpload
{
    public function uploadFile(UploadedFile $file, string $dir = 'uploads', string $disk = 'public'): ?string
    {
        // Validate disk type
        if (!in_array($disk, ['public', 'local'])) {
            throw new Exception('Invalid disk type. Must be either public or local');
        }

        // Handle file upload
        try
        {
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs($dir, $fileName, $disk);
            return "$dir/$fileName";
        }
        catch(\Throwable $exception)
        {
            throw $exception;
        }

        return null;
    }
}
