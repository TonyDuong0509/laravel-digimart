@extends('frontend.dashboard.layouts.master')
@section('content')
    <div class="profile">
        <div class="row gy-4">
            <div class="col-xxl-3 col-xl-4">
                <div class="profile-info">
                    <div class="profile-info__inner mb-40 text-center">

                        <div class="avatar-upload mb-24">
                            <div class="avatar-preview" style="background-image: url('{{ asset($user->avatar) }}');">
                                <div id="imagePreview">
                                </div>
                            </div>
                        </div>

                        <h5 class="profile-info__name mb-1">{{ $user->name }}</h5>
                        <span class="profile-info__designation font-14">{{ ucfirst($user->user_type) }}</span>
                    </div>

                    <ul class="profile-info-list">
                        <li class="profile-info-list__item">
                            <span class="profile-info-list__content flx-align flex-nowrap gap-2">
                                <i class="ti ti-user"></i>
                                <span class="text text-heading fw-500">{{ __('Name') }}</span>
                            </span>
                            <span class="profile-info-list__info">{{ $user->name }}</span>
                        </li>
                        <li class="profile-info-list__item">
                            <span class="profile-info-list__content flx-align flex-nowrap gap-2">
                                <i class="ti ti-mail-forward"></i>
                                <span class="text text-heading fw-500">{{ __('Email') }}</span>
                            </span>
                            <span class="profile-info-list__info">{{ $user->email }}</span>
                        </li>
                        <li class="profile-info-list__item">
                            <span class="profile-info-list__content flx-align flex-nowrap gap-2">
                                <i class="ti ti-map-pin"></i>
                                <span class="text text-heading fw-500">{{ __('Country') }}</span>
                            </span>
                            <span class="profile-info-list__info">{{ $user->country }}</span>
                        </li>
                        <li class="profile-info-list__item">
                            <span class="profile-info-list__content flx-align flex-nowrap gap-2">
                                <i class="ti ti-currency-dollar"></i>
                                <span class="text text-heading fw-500">{{ __('Balance') }}</span>
                            </span>
                            <span class="profile-info-list__info">$0.00 USD</span>
                        </li>
                        <li class="profile-info-list__item">
                            <span class="profile-info-list__content flx-align flex-nowrap gap-2">
                                <i class="ti ti-basket-check"></i>
                                <span class="text text-heading fw-500">{{ __('Purchased') }}</span>
                            </span>
                            <span class="profile-info-list__info">0 items</span>
                        </li>
                    </ul>

                </div>
            </div>
            <div class="col-xxl-9 col-xl-8">
                <div class="dashboard-card">
                    <div class="dashboard-card__header pb-0">
                        <ul class="nav tab-bordered nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link font-18 font-heading active" id="pills-personalInfo-tab"
                                    data-bs-toggle="pill" data-bs-target="#pills-personalInfo" type="button" role="tab"
                                    aria-controls="pills-personalInfo"
                                    aria-selected="true">{{ __('Personal
                                                                            Info') }}</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link font-18 font-heading" id="pills-payouts-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-payouts" type="button" role="tab"
                                    aria-controls="pills-payouts" aria-selected="false">{{ __('Payouts') }}</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link font-18 font-heading" id="pills-changePassword-tab"
                                    data-bs-toggle="pill" data-bs-target="#pills-changePassword" type="button"
                                    role="tab" aria-controls="pills-changePassword"
                                    aria-selected="false">{{ __('Change
                                                                            Password') }}</button>
                            </li>
                        </ul>
                    </div>

                    <div class="profile-info-content">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-personalInfo" role="tabpanel"
                                aria-labelledby="pills-personalInfo-tab" tabindex="0">
                                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data"
                                    autocomplete="off">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-sm-6 col-xs-6">
                                            <div class="form_box">
                                                <label for="avatar"
                                                    class="form-label mb-2 font-18 font-heading fw-600">{{ __('Avatar') }}</label>
                                                <input type="file" class="common-input border" id="avatar"
                                                    name="avatar">
                                                <x-input-error :message="$errors->first('avatar')" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-6">
                                            <div class="form_box">
                                                <label for="name"
                                                    class="form-label mb-2 font-18 font-heading fw-600">{{ __('Full Name') }}</label>
                                                <input type="text" class="common-input border" id="name"
                                                    value="{{ old('name', $user->name) }}" placeholder="Full Name"
                                                    name="name">
                                                <x-input-error :message="$errors->first('name')" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-6">
                                            <div class="form_box">
                                                <label for="email"
                                                    class="form-label mb-2 font-18 font-heading fw-600">{{ __('Email') }}</label>
                                                <input type="text" class="common-input border" id="email"
                                                    value="{{ old('email', $user->email) }}" placeholder="Email"
                                                    name="email">
                                                <x-input-error :message="$errors->first('email')" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-6">
                                            <div class="form_box">
                                                <label for="country"
                                                    class="form-label mb-2 font-18 font-heading fw-600">{{ __('Country') }}</label>
                                                <div class="select-has-icon">
                                                    <select class="common-input border select_2" id="country"
                                                        name="country">
                                                        @foreach (config('options.countries') as $key => $value)
                                                            <option @selected($user->country == $value)
                                                                value="{{ $value }}">{{ $value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-6">
                                            <div class="form_box">
                                                <label for="city"
                                                    class="form-label mb-2 font-18 font-heading fw-600">{{ __('City') }}</label>
                                                <input type="text" class="common-input border" id="city"
                                                    name="city" value="{{ old('city', $user->city) }}">
                                                 <x-input-error :message="$errors->first('city')" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-6">
                                            <div class="form_box">
                                                <label for="address"
                                                    class="form-label mb-2 font-18 font-heading fw-600">{{ __('Address') }}</label>
                                                <input type="text" class="common-input border" id="address"
                                                    name="address" value="{{ old('address', $user->address) }}">
                                                <x-input-error :message="$errors->first('address')" />
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-main btn-lg">
                                                {{ __('Update Profile') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="pills-payouts" role="tabpanel"
                                aria-labelledby="pills-payouts-tab" tabindex="0">
                                <form action="#" autocomplete="off">
                                    <div class="row">
                                        <div class="col-sm-6 col-xs-6">
                                            <div class="form_box">
                                                <label for="name"
                                                    class="form-label mb-2 font-18 font-heading fw-600">Full
                                                    Name</label>
                                                <input type="text" class="common-input border" id="name"
                                                    value="{{ $user->name }}" placeholder="Full Name">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-6">
                                            <div class="form_box">
                                                <label for="emailAdd"
                                                    class="form-label mb-2 font-18 font-heading fw-600">Email
                                                    Address</label>
                                                <input type="email" class="common-input border" id="emailAdd"
                                                    value="michel15@gmail.com" placeholder="Email Address">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-6">
                                            <div class="form_box">
                                                <label for="city"
                                                    class="form-label mb-2 font-18 font-heading fw-600">City</label>
                                                <div class="select-has-icon">
                                                    <select class="common-input border" id="city">
                                                        <option value="1">Dhaka</option>
                                                        <option value="1">Chandpur</option>
                                                        <option value="1">Comilla</option>
                                                        <option value="1">Rangpur</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <button class="btn btn-main btn-lg"> Pay Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="pills-changePassword" role="tabpanel"
                                aria-labelledby="pills-changePassword-tab" tabindex="0">
                                <form action="{{ route('profile.update.password') }}" method="POST" autocomplete="off">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form_box">
                                                <label for="current-password"
                                                    class="form-label mb-2 font-18 font-heading fw-600">{{ __('Current Password') }}</label>
                                                <div class="position-relative">
                                                    <input type="password"
                                                        class="common-input common-input--withIcon common-input--withLeftIcon "
                                                        id="current-password" placeholder="************" name="current_password">
                                                    <span class="input-icon input-icon--left"><img
                                                            src="{{ asset('assets/frontend/images/icons/key-icon.svg')}}" alt=""></span>
                                                </div>
                                                <x-input-error :message="$errors->first('current_password')" />
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-xs-6">
                                            <div class="form_box">
                                                <label for="new-password"
                                                    class="form-label mb-2 font-18 font-heading fw-600">{{ __('New
                                                    Password') }}</label>
                                                <div class="position-relative">
                                                    <input type="password"
                                                        class="common-input common-input--withIcon common-input--withLeftIcon "
                                                        id="new-password" placeholder="************" name="password">
                                                        <span class="input-icon input-icon--left"><img
                                                            src="{{ asset('assets/frontend/images/icons/key-icon.svg')}}" alt=""></span>
                                                </div>
                                                <x-input-error :message="$errors->first('password')" />
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-xs-6">
                                            <div class="form_box">
                                                <label for="confirm-password"
                                                    class="form-label mb-2 font-18 font-heading fw-600">{{ __('Password Confirmation') }}</label>
                                                <div class="position-relative">
                                                    <input type="password"
                                                        class="common-input common-input--withIcon common-input--withLeftIcon "
                                                        id="confirm-password" placeholder="************" name="password_confirmation">
                                                        <span class="input-icon input-icon--left"><img
                                                            src="{{ asset('assets/frontend/images/icons/key-icon.svg')}}" alt=""></span>
                                                </div>
                                                <x-input-error :message="$errors->first('password_confirmation')" />
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <button class="btn btn-main btn-lg">{{ __('Update Password') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
