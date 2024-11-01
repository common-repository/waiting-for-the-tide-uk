<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1ab20f096c0740b621f0e28acee2e3cc
{
    public static $files = array (
        '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/..' . '/ralouphie/getallheaders/src/getallheaders.php',
        'c964ee0ededf28c96ebd9db5099ef910' => __DIR__ . '/..' . '/guzzlehttp/promises/src/functions_include.php',
        '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..' . '/symfony/polyfill-ctype/bootstrap.php',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        '37a3dc5111fe8f707ab4c132ef1dbc62' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/functions_include.php',
    );

    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Twig\\' => 5,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Polyfill\\Ctype\\' => 23,
        ),
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
            'Psr\\Http\\Client\\' => 16,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
            'GuzzleHttp\\Promise\\' => 19,
            'GuzzleHttp\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Twig\\' => 
        array (
            0 => __DIR__ . '/..' . '/twig/twig/src',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Polyfill\\Ctype\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-ctype',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-factory/src',
            1 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Psr\\Http\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-client/src',
        ),
        'GuzzleHttp\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src',
        ),
        'GuzzleHttp\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/promises/src',
        ),
        'GuzzleHttp\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/guzzle/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'SikTec\\Exceptions\\InvalidArgumentException' => __DIR__ . '/../..' . '/src/templating/exceptions/InvalidArgumentException.php',
        'SikTec\\Exceptions\\RuntimeException' => __DIR__ . '/../..' . '/src/templating/exceptions/RuntimeException.php',
        'SikTec\\SikTemplates\\Exception' => __DIR__ . '/../..' . '/src/templating/exceptions/Exception.php',
        'SikTec\\SikTemplates\\Template' => __DIR__ . '/../..' . '/src/templating/SikTemplate.class.php',
        'TidePlugin\\Inputs\\InputField' => __DIR__ . '/../..' . '/src/Inputs/InputField.php',
        'TidePlugin\\Inputs\\NumberField' => __DIR__ . '/../..' . '/src/Inputs/NumberField.php',
        'TidePlugin\\Inputs\\SelectField' => __DIR__ . '/../..' . '/src/Inputs/SelectField.php',
        'TidePlugin\\Inputs\\TextAreaField' => __DIR__ . '/../..' . '/src/Inputs/TextAreaField.php',
        'TidePlugin\\Inputs\\TextField' => __DIR__ . '/../..' . '/src/Inputs/TextField.php',
        'TidePlugin\\Inputs\\ToggleField' => __DIR__ . '/../..' . '/src/Inputs/ToggleField.php',
        'TidePlugin\\MainPlugin' => __DIR__ . '/../..' . '/src/MainPlugin.class.php',
        'TidePlugin\\ShortCode' => __DIR__ . '/../..' . '/src/TideShortcode.class.php',
        'TidePlugin\\Tide' => __DIR__ . '/../..' . '/src/Tide.class.php',
        'TidePlugin\\Widgets\\TideTableWidget' => __DIR__ . '/../..' . '/src/Widgets.class.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1ab20f096c0740b621f0e28acee2e3cc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1ab20f096c0740b621f0e28acee2e3cc::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1ab20f096c0740b621f0e28acee2e3cc::$classMap;

        }, null, ClassLoader::class);
    }
}
