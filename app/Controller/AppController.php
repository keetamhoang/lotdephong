<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package        app.Controller
 * @link        http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    public $components = array(
        'Paginator',
        'Session',
        'RequestHandler'
    );

    public $helpers = array('Form', 'Html', 'Js', 'Time', 'Translate', 'Cache');

    public $website = 'Lót dép hóng';

    public $limit = 3;
    public $limitPost = 3;
    public $prefix = 'mobile_';

    function beforeFilter() {
        if ($this->Session->read('Auth.User')) {
            $this->set(array('checkLogin' => 1,
                'avatar' => $this->Session->read('Auth.User.avatar'),
                'userId' => $this->Session->read('Auth.User.id')));
        } else {
            $this->set(array('checkLogin' => 0,
                'userId' => ''));
        }
    }

    function beforeRender() {
        if($this->name == 'CakeError') {
            if (DEVICE == 'mobile') {
                $this->layout = 'error-default';
            } else if (DEVICE == 'desktop') {
                $this->layout = 'error-default';
            }
        } else {
            if (DEVICE == 'mobile') {
                $this->layout = 'mobile';
            } else if (DEVICE == 'desktop') {
                $this->layout = 'default';
            }
        }
    }
}
