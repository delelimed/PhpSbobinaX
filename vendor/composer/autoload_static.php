<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd26f272d6cdc5475fb2229d340a7c8c7
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'TelegramBot\\Api\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'TelegramBot\\Api\\' => 
        array (
            0 => __DIR__ . '/..' . '/telegram-bot/api/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd26f272d6cdc5475fb2229d340a7c8c7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd26f272d6cdc5475fb2229d340a7c8c7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd26f272d6cdc5475fb2229d340a7c8c7::$classMap;

        }, null, ClassLoader::class);
    }
}