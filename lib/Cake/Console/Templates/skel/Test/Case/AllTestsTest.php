<?php

/**
 * AllTests file
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Test.Case
 * @since         CakePHP(tm) v 2.5
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
class AllTestsTest extends CakeTestSuite
{

    /**
     * Get the suite object.
     *
     * @return CakeTestSuite Suite class instance.
     */
    public static function suite()
    {
        $suite = new CakeTestSuite('All application tests');
        $suite->addTestDirectoryRecursive(TESTS . 'Case');
        return $suite;
    }
}