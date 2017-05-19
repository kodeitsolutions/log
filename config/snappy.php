<?php

if(PHP_OS == 'WINNT'){
    return [
        'pdf'=>[
            'enabled'=>true,
            'binary' => '"C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf.exe"',
            'options'=>[],
        ],
        'image'=>[
            'enabled' => true,
            'binary' => '"C:\Program Files\wkhtmltopdf\bin\wkhtmltoimage.exe"',
            'options' => [],
        ]
    ];
}else{

    return array(


        'pdf' => array(
            'enabled' => true,
            'binary'  => '/usr/local/bin/wkhtmltopdf',
            'timeout' => false,
            'options' => array(),
            'env'     => array(),
        ),
        'image' => array(
            'enabled' => true,
            'binary'  => '/usr/local/bin/wkhtmltoimage',
            'timeout' => false,
            'options' => array(),
            'env'     => array(),
        ),
    );
}