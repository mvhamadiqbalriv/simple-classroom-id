<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'), ['icon' => 'solid/home.svg']);
});

// Home > User
Breadcrumbs::for('user', function ($trail) {
    $trail->parent('home');
    $trail->push('Users', route('users.index'));
});

// Home > User > Tambah
Breadcrumbs::for('user_create', function ($trail) {
    $trail->parent('user');
    $trail->push('Tambah', route('users.create'));
});

// Home > User > Edit
Breadcrumbs::for('user_edit', function ($trail, $user) {
    $trail->parent('user');
    $trail->push($user->username, route('users.show', $user->username));
});

// Home > Classroom
Breadcrumbs::for('classroom', function ($trail) {
    $trail->parent('home');
    $trail->push('Kelas', route('classrooms.index'));
});

// Home > Classroom > Tambah
Breadcrumbs::for('classroom_create', function ($trail) {
    $trail->parent('classroom');
    $trail->push('Tambah', route('classrooms.create'));
});

// Home > Classroom > Edit
Breadcrumbs::for('classroom_edit', function ($trail, $classroom) {
    $trail->parent('classroom');
    $trail->push($classroom->nama_kelas, route('classrooms.show', $classroom->token));
});

// Home > Deskjobs
Breadcrumbs::for('deskjobs', function ($trail) {
$trail->parent('home');
$trail->push('Tugas', route('deskjobs.index'));
});

// Home > Tugas > Tambah
Breadcrumbs::for('deskjobs_create', function ($trail) {
$trail->parent('deskjobs');
$trail->push('Tambah', route('deskjobs.create'));
});

// Home > Tugas > Detail
Breadcrumbs::for('deskjob_detail', function ($trail, $deskjob) {
$trail->parent('deskjobs');
$trail->push($deskjob->judul, route('deskjobs.show', $deskjob->slug));
});

