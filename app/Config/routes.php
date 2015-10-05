<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */


Router::connect('/', array('controller' => 'pages', 'action' => 'index'));

Router::connect(
    '/su-kien/:id-:slug',
    array('controller' => 'events', 'action' => 'view'),
    array(
        'pass' => array('id', 'slug'),
        'id' => '[0-9]+'
    )
);

if (DEVICE == 'mobile') {
    Router::connect(
        '/su-kien/:event/trang/:page',
        array('controller' => 'events', 'action' => 'view'),
        array(
            'pass' => array('event', 'page'),
            'event' => '[a-z0-9-]+',
        )
    );
} else {
    Router::connect(
        '/su-kien/:event/trang/:page',
        array('controller' => 'ajax', 'action' => 'load_more_posts'),
        array(
            'pass' => array('event', 'page'),
            'event' => '[a-z0-9-]+',
        )
    );    
}

Router::connect('/su-kien', array('controller' => 'events', 'action' => 'index'));

Router::connect('/moi', array('controller' => 'events', 'action' => 'index'));

Router::connect(
    '/moi/trang/:page',
    array('controller' => 'events', 'action' => 'index'),
    array(
        'pass' => array('page'),
        'page' => '[\d]+'
    )
);

Router::connect('/hot', array('controller' => 'events', 'action' => 'hot'));

Router::connect(
    '/hot/trang/:page',
    array('controller' => 'events', 'action' => 'hot'),
    array(
        'pass' => array('page'),
        'page' => '[\d]+'
    )
);

Router::connect('/cu', array('controller' => 'events', 'action' => 'old'));

Router::connect(
    '/cu/trang/:page',
    array('controller' => 'events', 'action' => 'old'),
    array(
        'pass' => array('page'),
        'page' => '[\d]+'
    )
);

Router::connect('/danh-muc', array('controller' => 'categories', 'action' => 'index'));

Router::connect(
    '/danh-muc/:id-:slug',
    array('controller' => 'categories', 'action' => 'view'),
    array(
        'pass' => array('id', 'slug'),
        'id' => '[0-9]+'
    )
);

Router::connect(
    '/danh-muc/trang/:page',
    array('controller' => 'categories', 'action' => 'index'),
    array(
        'pass' => array('page'),
        'page' => '[\d]+'
    )
);

Router::connect(
    '/danh-muc/:category/trang/:page',
    array('controller' => 'categories', 'action' => 'view'),
    array(
        'pass' => array('category', 'page'),
        'category' => '[a-z0-9-]+'
    )
);

Router::connect(
    '/trang/:page',
    array('controller' => 'pages', 'action' => 'index'),
    array(
        'pass' => array('page'),
        'page' => '[a-z0-9-]+'
    )
);

//Router::connect('/gui-bai', array('controller' => 'send', 'action' => 'send_post_user'));
Router::connect('/gui-bai/:id', array('controller' => 'send', 'action' => 'send_post_each_event'),
    array(
        'pass' => array('id'),
        'id' => '[0-9]+'
    ));

if (DEVICE != 'mobile') {
    Router::connect('/dang-nhap', array('controller' => 'users', 'action' => 'login'));
    Router::connect('/dang-xuat', array('controller' => 'users', 'action' => 'logout'));
}

Router::connect('/waiting/*', array('controller' => 'users', 'action' => 'insert_user'));

Router::connect('/dieu-khoan', array('controller' => 'pages', 'action' => 'clause'));
Router::connect('/lien-he', array('controller' => 'pages', 'action' => 'contact'));
Router::connect('/thong-bao', array('controller' => 'pages', 'action' => 'showAll'));

//Admin
Router::connect('/admin', array('plugin' => 'Admin', 'controller' => 'AdminUsers', 'action' => 'login'));
Router::connect('/admin/login', array('plugin' => 'Admin', 'controller' => 'AdminUsers', 'action' => 'login'));
Router::connect('/admin/logout', array('plugin' => 'Admin', 'controller' => 'AdminUsers', 'action' => 'logout'));
Router::connect('/admin/users/dang-ky', array('plugin' => 'Admin', 'controller' => 'AdminUsers', 'action' => 'registerUser'));
Router::connect('/admin/dashboard', array('plugin' => 'Admin', 'controller' => 'AdminPages', 'action' => 'index'));
Router::connect('/admin/events', array('plugin' => 'Admin', 'controller' => 'AdminEvents', 'action' => 'index'));
Router::connect('/admin/events/add', array('plugin' => 'Admin', 'controller' => 'AdminEvents', 'action' => 'add'));
Router::connect('/admin/events/delete/:id', array('plugin' => 'Admin', 'controller' => 'AdminEvents', 'action' => 'delete'),array(
    'pass' => array('id'),
    'id' => '[0-9-]+'
));
Router::connect('/admin/events/edit/:id', array('plugin' => 'Admin', 'controller' => 'AdminEvents', 'action' => 'edit'), array(
    'pass' => array('id'),
    'id' => '[0-9-]+'
));
Router::connect('/admin/events/view/:id', array('plugin' => 'Admin', 'controller' => 'AdminEvents', 'action' => 'view'), array(
    'pass' => array('id'),
    'id' => '[0-9-]+'
));
Router::connect('/admin/events/censorship/:id', array('plugin' => 'Admin', 'controller' => 'AdminEvents', 'action' => 'censorship'), array(
    'pass' => array('id'),
    'id' => '[0-9-]+'
));

Router::connect('/admin/waitings/publish/:id', array('plugin' => 'Admin', 'controller' => 'AdminWaitings', 'action' => 'publish'),array(
    'pass' => array('id'),
    'id' => '[0-9-]+'
));
Router::connect('/admin/waitings/delete/:id', array('plugin' => 'Admin', 'controller' => 'AdminWaitings', 'action' => 'delete'),array(
    'pass' => array('id'),
    'id' => '[0-9-]+'
));

Router::connect('/admin/posts', array('plugin' => 'Admin', 'controller' => 'AdminPosts', 'action' => 'index'));
Router::connect('/admin/posts/add', array('plugin' => 'Admin', 'controller' => 'AdminPosts', 'action' => 'add'));
Router::connect('/admin/posts/add/:id', array('plugin' => 'Admin', 'controller' => 'AdminPosts', 'action' => 'add'), array(
    'pass' => array('id'),
    'id' => '[0-9-]+'
));
Router::connect('/admin/posts/edit/:id', array('plugin' => 'Admin', 'controller' => 'AdminPosts', 'action' => 'edit'), array(
    'pass' => array('id'),
    'id' => '[0-9-]+'
));
Router::connect('/admin/posts/delete/:id', array('plugin' => 'Admin', 'controller' => 'AdminPosts', 'action' => 'delete'),array(
    'pass' => array('id'),
    'id' => '[0-9-]+'
));

Router::connect('/admin/categories', array('plugin' => 'Admin', 'controller' => 'AdminCategories', 'action' => 'index'));
Router::connect('/admin/categories/add', array('plugin' => 'Admin', 'controller' => 'AdminCategories', 'action' => 'add'));
Router::connect('/admin/categories/edit/:id', array('plugin' => 'Admin', 'controller' => 'AdminCategories', 'action' => 'edit'), array(
    'pass' => array('id'),
    'id' => '[0-9-]+'
));
Router::connect('/admin/categories/delete/:id', array('plugin' => 'Admin', 'controller' => 'AdminCategories', 'action' => 'delete'),array(
    'pass' => array('id'),
    'id' => '[0-9-]+'
));

Router::connect('/admin/users/member', array('plugin' => 'Admin', 'controller' => 'AdminUsers', 'action' => 'member'));
Router::connect('/admin/users/manager', array('plugin' => 'Admin', 'controller' => 'AdminUsers', 'action' => 'manager'));
Router::connect('/admin/users/manager/edit/:id', array('plugin' => 'Admin', 'controller' => 'AdminUsers', 'action' => 'edit'), array(
    'pass' => array('id'),
    'id' => '[0-9-]+'
));
Router::connect('/admin/users/manager/delete/:id', array('plugin' => 'Admin', 'controller' => 'AdminUsers', 'action' => 'deleteManager'), array(
    'pass' => array('id'),
    'id' => '[0-9-]+'
));
Router::connect('/admin/users/member/delete/:id', array('plugin' => 'Admin', 'controller' => 'AdminUsers', 'action' => 'deleteMember'), array(
    'pass' => array('id'),
    'id' => '[0-9-]+'
));

Router::connect('/admin/reports', array('plugin' => 'Admin', 'controller' => 'AdminReports', 'action' => 'index'));
Router::connect('/admin/reports/delete/:id', array('plugin' => 'Admin', 'controller' => 'AdminReports', 'action' => 'delete'), array(
    'pass' => array('id'),
    'id' => '[0-9-]+'
));

Router::connect('/admin/follows/following', array('plugin' => 'Admin', 'controller' => 'AdminFollows', 'action' => 'following'));
Router::connect('/admin/follows/unfollow', array('plugin' => 'Admin', 'controller' => 'AdminFollows', 'action' => 'unfollow'));

Router::connect('/admin/waitings/wait', array('plugin' => 'Admin', 'controller' => 'AdminWaitings', 'action' => 'wait'));
Router::connect('/admin/waitings/done', array('plugin' => 'Admin', 'controller' => 'AdminWaitings', 'action' => 'done'));

Router::connect('/admin/update_comment', array('controller' => 'CountComment', 'action' => 'updateComment'));

/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
//Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
require CAKE . 'Config' . DS . 'routes.php';
