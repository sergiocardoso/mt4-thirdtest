<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit89efe6ec2b0bfc0a1ad95dd3c109ba4f
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MT4\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MT4\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/MT4',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit89efe6ec2b0bfc0a1ad95dd3c109ba4f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit89efe6ec2b0bfc0a1ad95dd3c109ba4f::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
