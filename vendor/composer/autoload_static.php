<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf9fd6cf294252f3b912831e2a6b6b1ff
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Curl\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Curl\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-curl-class/php-curl-class/src/Curl',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf9fd6cf294252f3b912831e2a6b6b1ff::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf9fd6cf294252f3b912831e2a6b6b1ff::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}