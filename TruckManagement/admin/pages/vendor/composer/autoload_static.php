<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitec9587d736cf93e6f0115be8217526ca
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Twilio\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Twilio\\' => 
        array (
            0 => __DIR__ . '/..' . '/twilio/sdk/src/Twilio',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitec9587d736cf93e6f0115be8217526ca::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitec9587d736cf93e6f0115be8217526ca::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitec9587d736cf93e6f0115be8217526ca::$classMap;

        }, null, ClassLoader::class);
    }
}
