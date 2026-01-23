<?php

return [

    /*
     |------------------------------------------------------------------
     | Force HTTPS
     |------------------------------------------------------------------
     */
    'force_https' => true,
    // config/backpack/basset.php
    'disk' => env('BASSET_DISK', 'public'), // Garanta que lê do .env
    'cache_path' => 'basset',               // O caminho dentro do bucket

];
