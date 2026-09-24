<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Prefix URL yang langsung diblokir (lebih cepat)
    |--------------------------------------------------------------------------
    */

    'prefixes' => [

        'wp-admin',
        'wp-content',
        'wp-includes',
        'vendor',
        'storage',
        'cgi-bin',
        'dss/dss/',
        'old/',
        'test/',
        'testing/',
        'demo/',
        'dev/',
        'backup/',
        'backups/',

    ],

    /*
    |--------------------------------------------------------------------------
    | Pattern Regex
    |--------------------------------------------------------------------------
    */

    'patterns' => [

        '#^wp-login\.php$#i',
        '#^xmlrpc\.php$#i',
        '#^readme\.html$#i',
        '#^license\.txt$#i',

        '#\.env#i',
        '#composer\.(json|lock)#i',
        '#package-lock\.json#i',
        '#yarn\.lock#i',

        '#backup#i',
        '#backups#i',
        '#dump#i',
        '#db_backup#i',

        '#\.(bak|old|orig|save|tmp|temp|sql|sqlite|zip|rar|7z|tar|gz|tgz|bz2)$#i',

    ],

];