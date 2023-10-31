<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserSettings;
use App\Http\Requests\StoreUserSettingsRequest;
use App\Http\Requests\UpdateUserSettingsRequest;
use App\Http\Resources\UserSettingsResource;
use Illuminate\Support\Facades\Log;

class UserSettingsController extends Controller
{
    /**
     * Display the user's settings.
     *
     * @return UserSettingsResource
     */
    public function index()
    {
        $user_id = auth()->user()->id;

        $user_settings_data = UserSettings::where('user_id', $user_id)->first();

        return new UserSettingsResource($user_settings_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserSettingsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserSettingsRequest $request)
    {

        $userSettings = new UserSettings;
        $userSettings->user_id = auth()->user()->id;
        $userSettings->image = $request->input('image'); // Assuming 'image' is a field in your request
        $userSettings->company_name = $request->input('companyName');
        $userSettings->company_address = $request->input('companyAddress');
        $userSettings->city_zip_code = $request->input('cityZipCode');
        $userSettings->country = $request->input('country');
        Log::info($userSettings);
        $userSettings->save();
        return response($userSettings);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserSettings  $userSettings
     * @return \Illuminate\Http\Response
     */
    public function show(UserSettings $userSettings)
    {
        $userSettings = auth()->user()->userSettings;

        return new UserSettingsResource($userSettings);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserSettingsRequest  $request
     * @param  \App\Models\UserSettings  $userSettings
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserSettingsRequest $request, UserSettings $userSettings)
    {
        // Validate and update user settings, including the base64 image and additional fields
        $userSettings = UserSettings::find($request->input('id'));

        $userSettings->image = $request->input('image'); // Assuming 'image' is a field in your request
        $userSettings->user_id = auth()->user()->id;
        $userSettings->company_name = $request->input('companyName');
        $userSettings->company_address = $request->input('companyAddress');
        $userSettings->city_zip_code = $request->input('cityZipCode');
        $userSettings->country = $request->input('country');
        $userSettings->save();
        return response($userSettings);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserSettings  $userSettings
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserSettings $userSettings)
    {
        //
    }
}
