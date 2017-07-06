<div class="logo">
    <a class="simple-text text-center">
        <img class="img-responsive center-block" src="{{ asset('img/logo.png') }}">
    </a>
</div>

<div class="sidebar-wrapper">
    <?php
    Menu::make('MyNavBar', function($menu) {
        if(Auth::user()->can('read-module-home')) {
            $menu->add(
                '<i class="material-icons">dashboard</i><p>Dashboard</p>',
                route('home.index')
            );
        }

        if(Auth::user()->can('read-module-profile')) {
            $menu->add(
                '<i class="material-icons">person</i><p>My Profile</p>',
                route('profile.index')
            );
        }

        if(Auth::user()->can('read-module-roles')) {
            $menu->add(
                '<i class="fa fa-certificate"></i><p>Manage Roles</p>',
                route('role.index')
            );
        }

        if(Auth::user()->can('read-module-admins')) {
            $menu->add(
                '<i class="fa fa-user-circle-o"></i><p>Admin List</p>',
                route('admin.index')
            );
        }

        if(Auth::user()->can('read-module-users')) {
            $menu->add(
                '<i class="fa fa-user-circle"></i><p>User List</p>',
                route('user.index')
            );
        }
    });
    echo Menu::get('MyNavBar')->asUl(['class' => 'nav']);
    ?>
</div>