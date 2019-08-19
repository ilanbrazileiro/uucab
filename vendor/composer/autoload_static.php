<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit443a21398e82cfa2257c895ebe06ff18
{
    public static $prefixLengthsPsr4 = array (
        'U' => 
        array (
            'Uucab\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Uucab\\' => 
        array (
            0 => __DIR__ . '/..' . '/src',
        ),
    );

    public static $classMap = array (
        'NFeAuthenticationException' => __DIR__ . '/..' . '/nfe/nfe/lib/NFe/Error.php',
        'NFeException' => __DIR__ . '/..' . '/nfe/nfe/lib/NFe/Error.php',
        'NFeObjectNotFound' => __DIR__ . '/..' . '/nfe/nfe/lib/NFe/Error.php',
        'NFe_APIChildResource' => __DIR__ . '/..' . '/nfe/nfe/lib/NFe/APIChildResource.php',
        'NFe_APIRequest' => __DIR__ . '/..' . '/nfe/nfe/lib/NFe/APIRequest.php',
        'NFe_APIResource' => __DIR__ . '/..' . '/nfe/nfe/lib/NFe/APIResource.php',
        'NFe_Company' => __DIR__ . '/..' . '/nfe/nfe/lib/NFe/Company.php',
        'NFe_LegalPerson' => __DIR__ . '/..' . '/nfe/nfe/lib/NFe/LegalPerson.php',
        'NFe_NaturalPerson' => __DIR__ . '/..' . '/nfe/nfe/lib/NFe/NaturalPerson.php',
        'NFe_Object' => __DIR__ . '/..' . '/nfe/nfe/lib/NFe/Object.php',
        'NFe_SearchResult' => __DIR__ . '/..' . '/nfe/nfe/lib/NFe/SearchResult.php',
        'NFe_ServiceInvoice' => __DIR__ . '/..' . '/nfe/nfe/lib/NFe/ServiceInvoice.php',
        'NFe_Utilities' => __DIR__ . '/..' . '/nfe/nfe/lib/NFe/Utilities.php',
        'NFe_Webhook' => __DIR__ . '/..' . '/nfe/nfe/lib/NFe/Webhook.php',
        'NFe_class_tools' => __DIR__ . '/..' . '/nfe/nfe/lib/NFe/Backward_Compatibility.php',
        'NFe_io' => __DIR__ . '/..' . '/nfe/nfe/lib/NFe/NFe.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit443a21398e82cfa2257c895ebe06ff18::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit443a21398e82cfa2257c895ebe06ff18::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit443a21398e82cfa2257c895ebe06ff18::$classMap;

        }, null, ClassLoader::class);
    }
}