<?php
return new \Phalcon\Config(array(
    'application' => array(
        'baseUri' => '/',
        'viewsDir' => 'assets/Views',
        'production' => false,
        'defaultModule' => 'app',
        'cryptSalt' => 'kSVLgM4zlB=k64FVQZw~l3Xa=',
        'routers' => array(
            array(
                'className' => 'App\\Router',
                'path' => 'assets/app/Router.php'
            )
        )
    ),
    'modules' => array(
        array(
            'name' => 'app',
            'path' => '/assets/app'
        )
    )
));
