<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0015e01829345c819135861d56e8c743
{
    public static $files = array (
        'e7e7c3504b6eaea207baa827f09bed14' => __DIR__ . '/../..' . '/source/Boot/Config.php',
        '581110dc86c0bf4f087e190eaf4b61d8' => __DIR__ . '/../..' . '/source/Boot/Helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Svg\\' => 4,
            'Source\\' => 7,
            'Sabberworm\\CSS\\' => 15,
        ),
        'M' => 
        array (
            'Masterminds\\' => 12,
        ),
        'L' => 
        array (
            'League\\Plates\\' => 14,
        ),
        'F' => 
        array (
            'FontLib\\' => 8,
        ),
        'D' => 
        array (
            'Dompdf\\' => 7,
        ),
        'C' => 
        array (
            'CoffeeCode\\Uploader\\' => 20,
            'CoffeeCode\\Router\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Svg\\' => 
        array (
            0 => __DIR__ . '/..' . '/phenx/php-svg-lib/src/Svg',
        ),
        'Source\\' => 
        array (
            0 => __DIR__ . '/../..' . '/source',
        ),
        'Sabberworm\\CSS\\' => 
        array (
            0 => __DIR__ . '/..' . '/sabberworm/php-css-parser/src',
        ),
        'Masterminds\\' => 
        array (
            0 => __DIR__ . '/..' . '/masterminds/html5/src',
        ),
        'League\\Plates\\' => 
        array (
            0 => __DIR__ . '/..' . '/league/plates/src',
        ),
        'FontLib\\' => 
        array (
            0 => __DIR__ . '/..' . '/phenx/php-font-lib/src/FontLib',
        ),
        'Dompdf\\' => 
        array (
            0 => __DIR__ . '/..' . '/dompdf/dompdf/src',
        ),
        'CoffeeCode\\Uploader\\' => 
        array (
            0 => __DIR__ . '/..' . '/coffeecode/uploader/src',
        ),
        'CoffeeCode\\Router\\' => 
        array (
            0 => __DIR__ . '/..' . '/coffeecode/router/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Dompdf\\Cpdf' => __DIR__ . '/..' . '/dompdf/dompdf/lib/Cpdf.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0015e01829345c819135861d56e8c743::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0015e01829345c819135861d56e8c743::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0015e01829345c819135861d56e8c743::$classMap;

        }, null, ClassLoader::class);
    }
}