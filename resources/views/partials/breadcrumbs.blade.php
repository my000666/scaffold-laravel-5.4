<?php
Breadcrumbs::for('main.index', function($breadcrumbs) {
    $breadcrumbs->add('<i class="fa fa-home"></i>', url('/'));
});


Breadcrumbs::for('home.index', function($breadcrumbs) {
    $breadcrumbs->parent('main.index');
    $breadcrumbs->add('Dashboard', route('home.index'));
});


Breadcrumbs::for('profile.index', function($breadcrumbs) {
    $breadcrumbs->parent('main.index');
    $breadcrumbs->add('My Profile', route('profile.index'));
});


Breadcrumbs::for('role.index', function($breadcrumbs) {
    $breadcrumbs->parent('main.index');
    $breadcrumbs->add('Manage Roles', route('role.index'));
});


Breadcrumbs::for('admin.index', function($breadcrumbs) {
    $breadcrumbs->parent('main.index');
    $breadcrumbs->add('Admin List', route('admin.index'));
});


Breadcrumbs::for('user.index', function($breadcrumbs) {
    $breadcrumbs->parent('main.index');
    $breadcrumbs->add('User List', route('user.index'));
});

echo Breadcrumbs::render(Route::currentRouteName());
?>