<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd00a4ca6daa4cfd3630fb6520d89944a
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Src\\' => 4,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Src\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd00a4ca6daa4cfd3630fb6520d89944a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd00a4ca6daa4cfd3630fb6520d89944a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd00a4ca6daa4cfd3630fb6520d89944a::$classMap;

        }, null, ClassLoader::class);
    }
}