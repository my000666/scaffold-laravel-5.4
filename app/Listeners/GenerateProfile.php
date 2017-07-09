<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Models\UserProfile;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use Storage;
use Avatar;

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
        
        $profile = new UserProfile();
        $profile->user_id = $event->user->id;
        $profile->avatar = '/avatars/' . md5($event->user->email) . '.png';
        $profile->save();

        Avatar::create($event->user->name)->save(storage_path('app/public') . $profile->avatar);
        Mail::to($event->user)->send(new \App\Mail\UserCreated($event->user, $event->password));
    }
}
