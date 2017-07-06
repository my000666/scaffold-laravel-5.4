<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Models\UserProfile;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenerateProfile
{
    public function __construct()
    {
        //
    }

    public function handle(UserCreated $event)
    {
        if(!Storage::disk('public')->exists('avatars')) {
            Storage::disk('public')->makeDirectory('avatars');
        }
        
        $user = User::find($event->user_id);
        $profile = UserProfile::firstOrNew(['user_id' => $user->id]);

        if($user->profile) {
            //
        }
        
        $profile->avatar = sprintf('/avatars/%s.png', md5($user->email));
        $profile->address_1 = $request->address_1;
        $profile->address_2 = $request->address_2;
        $profile->postcode = $request->postcode;
        $profile->city = $request->city;
        $profile->state = $request->state;
        $profile->country = $request->country;
        $profile->phone = $request->phone;
        $profile->office = $request->office;
        $profile->mobile = $request->mobile;
        $profile->save();

    }
}
