<?php


namespace Composer;

use Composer\Semver\VersionParser;


class InstalledVersions {
    private static $installed = array(
        'root' =>
            array(
                'pretty_version' => '1.0.0+no-version-set',
                'version' => '1.0.0.0',
                'aliases' =>
                    array(),
                'reference' => NULL,
                'name' => '__root__',
            ),
        'versions' =>
            array(
                '__root__' =>
                    array(
                        'pretty_version' => '1.0.0+no-version-set',
                        'version' => '1.0.0.0',
                        'aliases' =>
                            array(),
                        'reference' => NULL,
                    ),
                'mpdf/mpdf' =>
                    array(
                        'pretty_version' => 'v8.2.2',
                        'version' => '8.2.2.0',
                        'aliases' =>
                            array(),
                        'reference' => '596a87b876d7793be7be060a8ac13424de120dd5',
                    ),
                'mpdf/psr-http-message-shim' =>
                    array(
                        'pretty_version' => '1.0.0',
                        'version' => '1.0.0.0',
                        'aliases' =>
                            array(),
                        'reference' => '3206e6b80b6d2479e148ee497e9f2bebadc919db',
                    ),
                'mpdf/psr-log-aware-trait' =>
                    array(
                        'pretty_version' => 'v2.0.0',
                        'version' => '2.0.0.0',
                        'aliases' =>
                            array(),
                        'reference' => '7a077416e8f39eb626dee4246e0af99dd9ace275',
                    ),
                'myclabs/deep-copy' =>
                    array(
                        'pretty_version' => '1.11.1',
                        'version' => '1.11.1.0',
                        'aliases' =>
                            array(),
                        'reference' => '7284c22080590fb39f2ffa3e9057f10a4ddd0e0c',
                    ),
                'paragonie/random_compat' =>
                    array(
                        'pretty_version' => 'v9.99.100',
                        'version' => '9.99.100.0',
                        'aliases' =>
                            array(),
                        'reference' => '996434e5492cb4c3edcb9168db6fbb1359ef965a',
                    ),
                'psr/http-message' =>
                    array(
                        'pretty_version' => '1.0.1',
                        'version' => '1.0.1.0',
                        'aliases' =>
                            array(),
                        'reference' => 'f6561bf28d520154e4b0ec72be95418abe6d9363',
                    ),
                'psr/log' =>
                    array(
                        'pretty_version' => '1.1.4',
                        'version' => '1.1.4.0',
                        'aliases' =>
                            array(),
                        'reference' => 'd49695b909c3b7628b6289db5479a1c204601f11',
                    ),
                'setasign/fpdi' =>
                    array(
                        'pretty_version' => 'v2.6.0',
                        'version' => '2.6.0.0',
                        'aliases' =>
                            array(),
                        'reference' => 'a6db878129ec6c7e141316ee71872923e7f1b7ad',
                    ),
            ),
    );


    public static function getInstalledPackages() {
        return array_keys(self::$installed['versions']);
    }


    public static function isInstalled($packageName) {
        return isset(self::$installed['versions'][$packageName]);
    }


    public static function satisfies(VersionParser $parser, $packageName, $constraint) {
        $constraint = $parser->parseConstraints($constraint);
        $provided = $parser->parseConstraints(self::getVersionRanges($packageName));

        return $provided->matches($constraint);
    }


    public static function getVersionRanges($packageName) {
        if (!isset(self::$installed['versions'][$packageName])) {
            throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
        }

        $ranges = [];
        if (isset(self::$installed['versions'][$packageName]['pretty_version'])) {
            $ranges[] = self::$installed['versions'][$packageName]['pretty_version'];
        }
        if (array_key_exists('aliases', self::$installed['versions'][$packageName])) {
            $ranges = array_merge($ranges, self::$installed['versions'][$packageName]['aliases']);
        }
        if (array_key_exists('replaced', self::$installed['versions'][$packageName])) {
            $ranges = array_merge($ranges, self::$installed['versions'][$packageName]['replaced']);
        }
        if (array_key_exists('provided', self::$installed['versions'][$packageName])) {
            $ranges = array_merge($ranges, self::$installed['versions'][$packageName]['provided']);
        }

        return implode(' || ', $ranges);
    }


    public static function getVersion($packageName) {
        if (!isset(self::$installed['versions'][$packageName])) {
            throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
        }

        if (!isset(self::$installed['versions'][$packageName]['version'])) {
            return null;
        }

        return self::$installed['versions'][$packageName]['version'];
    }


    public static function getPrettyVersion($packageName) {
        if (!isset(self::$installed['versions'][$packageName])) {
            throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
        }

        if (!isset(self::$installed['versions'][$packageName]['pretty_version'])) {
            return null;
        }

        return self::$installed['versions'][$packageName]['pretty_version'];
    }


    public static function getReference($packageName) {
        if (!isset(self::$installed['versions'][$packageName])) {
            throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
        }

        if (!isset(self::$installed['versions'][$packageName]['reference'])) {
            return null;
        }

        return self::$installed['versions'][$packageName]['reference'];
    }


    public static function getRootPackage() {
        return self::$installed['root'];
    }


    public static function getRawData() {
        return self::$installed;
    }


    public static function reload($data) {
        self::$installed = $data;
    }
}
