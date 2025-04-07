<?php

return [
    'nama' => [
        // firstname adalah environment FIRST_NAME kalau tidak ada maka hanif
        'firstname' => env('FIRST_NAME', 'Hanif'),
        'lastname' => env('LAST_NAME', 'Kusuma'),
    ],
    'email' => 'hanifsmurf@gmail.com',
    'web' => 'hanif.com'
];