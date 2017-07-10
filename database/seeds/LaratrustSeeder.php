<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaratrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return  void
     */
    public function run()
    {
        $this->command->info('Truncating User, Role and Permission tables');
        $this->truncateLaratrustTables();

        $config = config('laratrust_seeder.role_structure');
        $userPermission = config('laratrust_seeder.permission_structure');
        $mapPermission = collect(config('laratrust_seeder.permissions_map'));
        $roleModes = config('laratrust_seeder.mode_structure');

        foreach ($config as $key => $modules) {
            // Create a new role
            $role = \App\Models\Role::create([
                'name' => $key,
                'display_name' => ucwords(str_replace("_", " ", $key)),
                'description' => ucwords(str_replace("_", " ", $key))
            ]);

            $this->command->info('Creating Role '. strtoupper($key));

            // Reading role permission modules
            foreach ($modules as $module => $value) {
                $permissions = explode(',', $value);

                foreach ($permissions as $p => $perm) {
                    $permissionValue = $mapPermission->get($perm);

                    $permission = \App\Models\Permission::firstOrCreate([
                        'name' => $permissionValue . '-' . $module,
                        'display_name' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                        'description' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                    ]);

                    $this->command->info('Creating Permission to '.$permissionValue.' for '. $module);

                    if (!$role->hasPermission($permission->name)) {
                        $role->attachPermission($permission);
                    } else {
                        $this->command->info($key . ': ' . $p . ' ' . $permissionValue . ' already exist');
                    }
                }
            }

            $this->command->info("Creating '{$key}' user");
            // Create default user for each role
            $user = \App\Models\User::create([
                'name' => ucwords(str_replace("_", " ", $key)),
                'email' => $key.'@app.com',
                'password' => bcrypt('password'),
                'remember_token' => str_random(10),
            ]);
            $user->attachRole($role);

            $profile = new \App\Models\UserProfile();
            $profile->user_id = $user->id;
            $profile->avatar = '/avatars/' . md5($user->email) . '.png';
            $profile->save();
            Avatar::create($user->name)->save(storage_path('app/public') . $profile->avatar);
        }

        // creating user with permissions
        if (!empty($userPermission)) {
            foreach ($userPermission as $key => $modules) {
                foreach ($modules as $module => $value) {
                    $permissions = explode(',', $value);
                    // Find or Create default user for each permission set
                    $user = \App\Models\User::firstOrCreate([
                        'name' => ucwords(str_replace("_", " ", $key)),
                        'email' => $key.'@app.com'
                    ]);
                    if($user->wasRecentlyCreated) {
                        $user->password = bcrypt('password');
                        $user->remember_token = str_random(10);
                        $user->save();

                        $profile = new \App\Models\UserProfile();
                        $profile->user_id = $user->id;
                        $profile->avatar = '/avatars/' . md5($user->email) . '.png';
                        $profile->save();
                        Avatar::create($user->name)->save(storage_path('app/public') . $profile->avatar);
                    }

                    foreach ($permissions as $p => $perm) {
                        $permissionValue = $mapPermission->get($perm);

                        $permission = \App\Models\Permission::firstOrCreate([
                            'name' => $permissionValue . '-' . $module,
                            'display_name' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                            'description' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                        ]);

                        $this->command->info('Creating Permission to '.$permissionValue.' for '. $module);

                        if (!$user->hasPermission($permission->name)) {
                            $user->attachPermission($permission);
                        } else {
                            $this->command->info($key . ': ' . $p . ' ' . $permissionValue . ' already exist');
                        }
                    }
                }
            }
        }

        foreach ($roleModes as $key => $roles) {
            $mode = \App\Models\Mode::firstOrCreate([
                'name' => str_slug($key),
                'display_name' => ucfirst($key),
                'description' => ucfirst($key),
            ]);

            foreach ($roles as $value) {
                $role = \App\Models\Role::where('name', $value)->first();
                \App\Models\ModeRole::create([
                    'mode_id' => $mode->id,
                    'role_id' => $role->id
                ]);
            }
        }
    }
    
    /**
     * Truncates all the laratrust tables and the users table
     * @return    void
     */
    public function truncateLaratrustTables()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('permission_role')->truncate();
        DB::table('permission_user')->truncate();
        DB::table('role_user')->truncate();
        \App\Models\User::truncate();
        \App\Models\UserProfile::truncate();
        \App\Models\Role::truncate();
        \App\Models\Permission::truncate();
        \App\Models\Mode::truncate();
        \App\Models\ModeRole::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
