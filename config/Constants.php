<?php

class Constants
{

    const DB = [ //DB connection configs
        'HOSTNAME' => 'localhost',
        'USERNAME' => 'root',
        'PASSWORD' => 'password',
        'DATABASE' => 'user_stories',
        'PORT' => 3306,
    ];
    const JWT = [
        'TOKEN_AUTHENTICATION' => true, // if token authorization is required
        'SECRET_KEY' => 'gdsvbckd5154dcftsygh54cds', // Secret key for token auth
        'TIME_TO_LIVE' => 6000, // Token life tme in seconds
    ];
}
