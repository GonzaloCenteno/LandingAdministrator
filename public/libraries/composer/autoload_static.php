<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd6fd49035d2923097622619ea7e670f4
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'SheetDB\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'SheetDB\\' => 
        array (
            0 => __DIR__ . '/..' . '/sheetdb/sheetdb-php/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd6fd49035d2923097622619ea7e670f4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd6fd49035d2923097622619ea7e670f4::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd6fd49035d2923097622619ea7e670f4::$classMap;

        }, null, ClassLoader::class);
    }
}
