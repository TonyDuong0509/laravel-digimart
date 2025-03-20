<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\PasswordUpdateRequest;
use App\Http\Requests\Frontend\ProfileUpdateRequest;
use App\Services\Library\NotificationService;
use App\Services\Website\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): View
    {
        $user = $this->userService->getAuthUser();
        return view('frontend.dashboard.profile.index', compact('user'));
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $this->userService->getAuthUser();
        if (!$user) {
            NotificationService::ERROR('Pleas login to update profile');
            return redirect()->route('login');
        }

        try
        {
            $data = $request->only(['name', 'email', 'country', 'city', 'address']);
            $requestFileName = 'avatar';
            $this->userService->updateProfile($user->id, $data, $requestFileName);
            NotificationService::UPDATED('Profile updated successfully');
        }
        catch(\Exception $e)
        {
            NotificationService::ERROR($e->getMessage());
        }

        return redirect()->back();
    }

    /**
     * Summary of updatePassword
     * @param \App\Http\Requests\Frontend\PasswordUpdateRequest $request
     * @return RedirectResponse
     */
    public function updatePassword(PasswordUpdateRequest $request): RedirectResponse
    {
        $user = $this->userService->getAuthUser();
        if (!$user) {
            NotificationService::ERROR('Pleas login to update profile');
            return redirect()->route('login');
        }

        try {
            $this->userService->updatePassword($user->id, $request->current_password);
            NotificationService::UPDATED('Password updated successfully');
        } catch (\Exception $e) {
            NotificationService::ERROR($e->getMessage());
        }
        
        return back();      
    }
}
