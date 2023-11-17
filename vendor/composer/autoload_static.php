<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitee2a69badd22ed540591704a09a9e999
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MCW\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MCW\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitee2a69badd22ed540591704a09a9e999::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitee2a69badd22ed540591704a09a9e999::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitee2a69badd22ed540591704a09a9e999::$classMap;

        }, null, ClassLoader::class);
    }
}
