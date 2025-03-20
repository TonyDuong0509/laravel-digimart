<?php

namespace App\Services\Website;

use App\Repositories\User\UserRepositoryInterface;
use App\Traits\FileUpload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    use FileUpload;

    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAuthUser()
    {
        if(Auth::check())
        {
            return Auth::user();
        }
        return null;
    }

    public function updateProfile($id, array $data, $requestFileName = null)
    {
        DB::beginTransaction();
        try
        {
            $user = $this->userRepository->find($id);
            if (!$user) {
                throw new \Exception('User not found');
            }

            if ($requestFileName && request()->hasFile($requestFileName)) {
                $file = request()->file($requestFileName);
                $data['avatar'] = $this->uploadFile($file);
            }

            foreach ($data as $key => $value) {
                $user->$key = $value;
            }

            $user->save();
            DB::commit();
            return $user;
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }
    }

    public function updatePassword($id, $currentPassword)
    {
        DB::beginTransaction();
        try
        {
            $user = $this->userRepository->find($id);
            if (!$user) {
                throw new \Exception('User not found');
            }

            if(!Hash::check($currentPassword, $user->password))
            {
                throw new \Exception('Current password is incorrect');
            }

            $user->password = bcrypt(request('password'));
            $user->save();
            DB::commit();
            return $user;
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }
    }
}
