<?php

/*
 * This file is part of RB28DETT.
 *
 * (c) Erik Campobadal <soc@erik.cat>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RB28DETT\RB28DETT;

use Illuminate\Support\Facades\Facade;

/**
 * This is the packages facade class.
 *
 * @author Erik Campobadal <soc@erik.cat>
 */
class Injector extends Facade
{
    /**
     * Returns the injection of the specified injector and package.
     *
     * @param string $package
     */
    public static function inject($injector, $package)
    {
        $dir = __DIR__."/../../$package/src/Injectors";
        $files = is_dir($dir) ? scandir($dir) : [];

        foreach ($files as $file) {
            if (substr($file, 0, -4) == $injector and substr($file, -4) == '.php') {
                $file = $dir.'/'.$file;

                return include $file;
            }
        }

        return '';
    }
}
