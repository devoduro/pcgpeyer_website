<?php

/*
|--------------------------------------------------------------------------
| Load The Cached Routes
|--------------------------------------------------------------------------
|
| Here we will decode and unserialize the RouteCollection instance that
| holds all of the route information for an application. This allows
| us to instantaneously load the entire route map into the router.
|
*/

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/_ignition/health-check' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.healthCheck',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_ignition/execute-solution' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.executeSolution',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_ignition/update-config' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.updateConfig',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::DLdQdN1k4FGAn4qk',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/about/history' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'about.history',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/about/staff' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'about.staff',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/about/leadership' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'about.leadership',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/about/ministers' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'about.ministers',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/group-leadership' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'group-leadership.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/ministries/inter-generational' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ministries.inter-generational',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/ministries/generational' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ministries.generational',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/media/photos' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'media.photos',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/media/videos' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'media.videos',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/gallery' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'gallery.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/videos' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'videos',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/contact' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'contact',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'contact.submit',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/news-update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'news-update',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.login.post',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.logout',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/profile' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.profile',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.profile.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.password.change',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/blog' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.blog.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.blog.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/blog/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.blog.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/sermons' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.sermons.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.sermons.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/sermons/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.sermons.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/ministries' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.ministries.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.ministries.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/ministries/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.ministries.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/gallery' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.galleries.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.galleries.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/gallery/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.galleries.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/videos' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.videos.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.videos.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/videos/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.videos.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/events' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.events.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.events.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/events/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.events.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/prayer-requests' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.prayer-requests.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/contact' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.contact.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/leadership/manage-years' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.leadership.manage-years',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.leadership.store-year',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/leadership/manage-titles' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.leadership.manage-titles',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.leadership.store-title',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/leadership' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.leadership.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.leadership.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/leadership/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.leadership.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/group-leadership' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.group-leadership.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.group-leadership.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/group-leadership/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.group-leadership.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/users/logs' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.users.logs',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/users' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.users.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.users.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/users/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.users.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/register' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.register',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.register.post',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/g(?|roup\\-leadership/([^/]++)(*:37)|allery/([^/]++)(*:59))|/ministries/([^/]++)(*:87)|/videos/([^/]++)(*:110)|/news\\-update/([^/]++)(*:140)|/dashboard/(?|blog/([^/]++)(?|(*:178)|/(?|edit(*:194)|toggle\\-publish(*:217))|(*:226))|sermons/([^/]++)(?|(*:254)|/(?|edit(*:270)|toggle\\-featured(*:294))|(*:303))|ministries/([^/]++)(?|(*:334)|/(?|edit(*:350)|toggle\\-active(*:372))|(*:381))|g(?|allery/([^/]++)(?|(*:412)|/edit(*:425)|(*:433))|roup\\-leadership/([^/]++)(?|(*:470)|/(?|edit(*:486)|toggle\\-active(*:508))|(*:517)))|videos/([^/]++)(?|(*:545)|/(?|edit(*:561)|toggle\\-(?|featured(*:588)|published(*:605)))|(*:615))|events/([^/]++)(?|(*:642)|/(?|edit(*:658)|toggle\\-featured(*:682))|(*:691))|prayer\\-requests/([^/]++)(?|(*:728)|/(?|mark\\-answered(*:754)|notes(*:767))|(*:776))|contact/([^/]++)(?|(*:804)|/re(?|ply(*:821)|solve(*:834))|(*:843))|leadership/(?|manage\\-(?|years/([^/]++)(?|(*:894)|/toggle(*:909)|(*:917))|titles/([^/]++)(?|(*:944)|/toggle(*:959)|(*:967)))|([^/]++)(?|(*:988)|/(?|edit(*:1004)|toggle\\-active(*:1027))|(*:1037)))|users/([^/]++)(?|(*:1065)|/(?|edit(*:1082)|toggle\\-active(*:1105))|(*:1115))))/?$}sDu',
    ),
    3 => 
    array (
      37 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'group-leadership.show',
          ),
          1 => 
          array (
            0 => 'groupLeadership',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      59 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'gallery.show',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      87 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ministries.show',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      110 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'videos.show',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      140 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'news-update.show',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      178 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.blog.show',
          ),
          1 => 
          array (
            0 => 'blog',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      194 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.blog.edit',
          ),
          1 => 
          array (
            0 => 'blog',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      217 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.blog.toggle-publish',
          ),
          1 => 
          array (
            0 => 'blog',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      226 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.blog.update',
          ),
          1 => 
          array (
            0 => 'blog',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.blog.destroy',
          ),
          1 => 
          array (
            0 => 'blog',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      254 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.sermons.show',
          ),
          1 => 
          array (
            0 => 'sermon',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      270 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.sermons.edit',
          ),
          1 => 
          array (
            0 => 'sermon',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      294 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.sermons.toggle-featured',
          ),
          1 => 
          array (
            0 => 'sermon',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      303 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.sermons.update',
          ),
          1 => 
          array (
            0 => 'sermon',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.sermons.destroy',
          ),
          1 => 
          array (
            0 => 'sermon',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      334 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.ministries.show',
          ),
          1 => 
          array (
            0 => 'ministry',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      350 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.ministries.edit',
          ),
          1 => 
          array (
            0 => 'ministry',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      372 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.ministries.toggle-active',
          ),
          1 => 
          array (
            0 => 'ministry',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      381 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.ministries.update',
          ),
          1 => 
          array (
            0 => 'ministry',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.ministries.destroy',
          ),
          1 => 
          array (
            0 => 'ministry',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      412 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.galleries.show',
          ),
          1 => 
          array (
            0 => 'gallery',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      425 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.galleries.edit',
          ),
          1 => 
          array (
            0 => 'gallery',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      433 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.galleries.update',
          ),
          1 => 
          array (
            0 => 'gallery',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.galleries.destroy',
          ),
          1 => 
          array (
            0 => 'gallery',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      470 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.group-leadership.show',
          ),
          1 => 
          array (
            0 => 'group_leadership',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      486 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.group-leadership.edit',
          ),
          1 => 
          array (
            0 => 'group_leadership',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      508 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.group-leadership.toggle-active',
          ),
          1 => 
          array (
            0 => 'groupLeadership',
          ),
          2 => 
          array (
            'PATCH' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      517 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.group-leadership.update',
          ),
          1 => 
          array (
            0 => 'group_leadership',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.group-leadership.destroy',
          ),
          1 => 
          array (
            0 => 'group_leadership',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      545 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.videos.show',
          ),
          1 => 
          array (
            0 => 'video',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      561 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.videos.edit',
          ),
          1 => 
          array (
            0 => 'video',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      588 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.videos.toggle-featured',
          ),
          1 => 
          array (
            0 => 'video',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      605 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.videos.toggle-published',
          ),
          1 => 
          array (
            0 => 'video',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      615 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.videos.update',
          ),
          1 => 
          array (
            0 => 'video',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.videos.destroy',
          ),
          1 => 
          array (
            0 => 'video',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      642 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.events.show',
          ),
          1 => 
          array (
            0 => 'event',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      658 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.events.edit',
          ),
          1 => 
          array (
            0 => 'event',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      682 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.events.toggle-featured',
          ),
          1 => 
          array (
            0 => 'event',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      691 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.events.update',
          ),
          1 => 
          array (
            0 => 'event',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.events.destroy',
          ),
          1 => 
          array (
            0 => 'event',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      728 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.prayer-requests.show',
          ),
          1 => 
          array (
            0 => 'prayerRequest',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      754 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.prayer-requests.mark-answered',
          ),
          1 => 
          array (
            0 => 'prayerRequest',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      767 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.prayer-requests.notes',
          ),
          1 => 
          array (
            0 => 'prayerRequest',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      776 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.prayer-requests.destroy',
          ),
          1 => 
          array (
            0 => 'prayerRequest',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      804 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.contact.show',
          ),
          1 => 
          array (
            0 => 'submission',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      821 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.contact.reply',
          ),
          1 => 
          array (
            0 => 'submission',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      834 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.contact.resolve',
          ),
          1 => 
          array (
            0 => 'submission',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      843 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.contact.destroy',
          ),
          1 => 
          array (
            0 => 'submission',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      894 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.leadership.update-year',
          ),
          1 => 
          array (
            0 => 'year',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      909 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.leadership.toggle-year',
          ),
          1 => 
          array (
            0 => 'year',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      917 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.leadership.delete-year',
          ),
          1 => 
          array (
            0 => 'year',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      944 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.leadership.update-title',
          ),
          1 => 
          array (
            0 => 'title',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      959 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.leadership.toggle-title',
          ),
          1 => 
          array (
            0 => 'title',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      967 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.leadership.delete-title',
          ),
          1 => 
          array (
            0 => 'title',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      988 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.leadership.show',
          ),
          1 => 
          array (
            0 => 'leadership',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1004 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.leadership.edit',
          ),
          1 => 
          array (
            0 => 'leadership',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1027 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.leadership.toggle-active',
          ),
          1 => 
          array (
            0 => 'leadership',
          ),
          2 => 
          array (
            'PATCH' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1037 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.leadership.update',
          ),
          1 => 
          array (
            0 => 'leadership',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.leadership.destroy',
          ),
          1 => 
          array (
            0 => 'leadership',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1065 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.users.show',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1082 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.users.edit',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1105 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.users.toggle-active',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1115 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.users.update',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.users.destroy',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        2 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'ignition.healthCheck' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_ignition/health-check',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\HealthCheckController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\HealthCheckController',
        'as' => 'ignition.healthCheck',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ignition.executeSolution' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '_ignition/execute-solution',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\ExecuteSolutionController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\ExecuteSolutionController',
        'as' => 'ignition.executeSolution',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ignition.updateConfig' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '_ignition/update-config',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\UpdateConfigController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\UpdateConfigController',
        'as' => 'ignition.updateConfig',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::DLdQdN1k4FGAn4qk' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:77:"function (\\Illuminate\\Http\\Request $request) {
    return $request->user();
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"000000000000089f0000000000000000";}}',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::DLdQdN1k4FGAn4qk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@index',
        'controller' => 'App\\Http\\Controllers\\HomeController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'home',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'about.history' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'about/history',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AboutController@history',
        'controller' => 'App\\Http\\Controllers\\AboutController@history',
        'as' => 'about.history',
        'namespace' => NULL,
        'prefix' => '/about',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'about.staff' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'about/staff',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AboutController@staff',
        'controller' => 'App\\Http\\Controllers\\AboutController@staff',
        'as' => 'about.staff',
        'namespace' => NULL,
        'prefix' => '/about',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'about.leadership' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'about/leadership',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AboutController@leadership',
        'controller' => 'App\\Http\\Controllers\\AboutController@leadership',
        'as' => 'about.leadership',
        'namespace' => NULL,
        'prefix' => '/about',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'about.ministers' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'about/ministers',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AboutController@ministers',
        'controller' => 'App\\Http\\Controllers\\AboutController@ministers',
        'as' => 'about.ministers',
        'namespace' => NULL,
        'prefix' => '/about',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'group-leadership.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'group-leadership',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\GroupLeadershipController@index',
        'controller' => 'App\\Http\\Controllers\\GroupLeadershipController@index',
        'as' => 'group-leadership.index',
        'namespace' => NULL,
        'prefix' => '/group-leadership',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'group-leadership.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'group-leadership/{groupLeadership}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\GroupLeadershipController@show',
        'controller' => 'App\\Http\\Controllers\\GroupLeadershipController@show',
        'as' => 'group-leadership.show',
        'namespace' => NULL,
        'prefix' => '/group-leadership',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ministries.inter-generational' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'ministries/inter-generational',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\MinistryController@interGenerational',
        'controller' => 'App\\Http\\Controllers\\MinistryController@interGenerational',
        'as' => 'ministries.inter-generational',
        'namespace' => NULL,
        'prefix' => '/ministries',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ministries.generational' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'ministries/generational',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\MinistryController@generational',
        'controller' => 'App\\Http\\Controllers\\MinistryController@generational',
        'as' => 'ministries.generational',
        'namespace' => NULL,
        'prefix' => '/ministries',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ministries.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'ministries/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\MinistryController@show',
        'controller' => 'App\\Http\\Controllers\\MinistryController@show',
        'as' => 'ministries.show',
        'namespace' => NULL,
        'prefix' => '/ministries',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'media.photos' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'media/photos',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\MediaController@photos',
        'controller' => 'App\\Http\\Controllers\\MediaController@photos',
        'as' => 'media.photos',
        'namespace' => NULL,
        'prefix' => '/media',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'media.videos' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'media/videos',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\MediaController@videos',
        'controller' => 'App\\Http\\Controllers\\MediaController@videos',
        'as' => 'media.videos',
        'namespace' => NULL,
        'prefix' => '/media',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'gallery.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'gallery',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\GalleryController@index',
        'controller' => 'App\\Http\\Controllers\\GalleryController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'gallery.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'gallery.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'gallery/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\GalleryController@show',
        'controller' => 'App\\Http\\Controllers\\GalleryController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'gallery.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'videos' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'videos',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\VideoController@index',
        'controller' => 'App\\Http\\Controllers\\VideoController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'videos',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'videos.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'videos/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\VideoController@show',
        'controller' => 'App\\Http\\Controllers\\VideoController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'videos.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'contact' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'contact',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ContactController@index',
        'controller' => 'App\\Http\\Controllers\\ContactController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'contact',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'contact.submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'contact',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ContactController@submit',
        'controller' => 'App\\Http\\Controllers\\ContactController@submit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'contact.submit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'news-update' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'news-update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\BlogController@index',
        'controller' => 'App\\Http\\Controllers\\BlogController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'news-update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'news-update.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'news-update/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\BlogController@show',
        'controller' => 'App\\Http\\Controllers\\BlogController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'news-update.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\AuthController@showLoginForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\AuthController@showLoginForm',
        'as' => 'dashboard.login',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.login.post' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dashboard/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\AuthController@login',
        'controller' => 'App\\Http\\Controllers\\Auth\\AuthController@login',
        'as' => 'dashboard.login.post',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.logout' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dashboard/logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\AuthController@logout',
        'controller' => 'App\\Http\\Controllers\\Auth\\AuthController@logout',
        'as' => 'dashboard.logout',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\DashboardController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\DashboardController@index',
        'as' => 'dashboard.index',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.profile' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/profile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\DashboardController@profile',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\DashboardController@profile',
        'as' => 'dashboard.profile',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.profile.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dashboard/profile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\DashboardController@updateProfile',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\DashboardController@updateProfile',
        'as' => 'dashboard.profile.update',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.password.change' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dashboard/password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\DashboardController@changePassword',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\DashboardController@changePassword',
        'as' => 'dashboard.password.change',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.blog.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/blog',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.blog.index',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\BlogPostController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\BlogPostController@index',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.blog.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/blog/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.blog.create',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\BlogPostController@create',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\BlogPostController@create',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.blog.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dashboard/blog',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.blog.store',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\BlogPostController@store',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\BlogPostController@store',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.blog.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/blog/{blog}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.blog.show',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\BlogPostController@show',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\BlogPostController@show',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.blog.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/blog/{blog}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.blog.edit',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\BlogPostController@edit',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\BlogPostController@edit',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.blog.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'dashboard/blog/{blog}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.blog.update',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\BlogPostController@update',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\BlogPostController@update',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.blog.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'dashboard/blog/{blog}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.blog.destroy',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\BlogPostController@destroy',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\BlogPostController@destroy',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.blog.toggle-publish' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dashboard/blog/{blog}/toggle-publish',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\BlogPostController@togglePublish',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\BlogPostController@togglePublish',
        'as' => 'dashboard.blog.toggle-publish',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.sermons.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/sermons',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.sermons.index',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\SermonController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\SermonController@index',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.sermons.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/sermons/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.sermons.create',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\SermonController@create',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\SermonController@create',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.sermons.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dashboard/sermons',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.sermons.store',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\SermonController@store',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\SermonController@store',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.sermons.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/sermons/{sermon}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.sermons.show',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\SermonController@show',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\SermonController@show',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.sermons.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/sermons/{sermon}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.sermons.edit',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\SermonController@edit',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\SermonController@edit',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.sermons.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'dashboard/sermons/{sermon}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.sermons.update',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\SermonController@update',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\SermonController@update',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.sermons.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'dashboard/sermons/{sermon}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.sermons.destroy',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\SermonController@destroy',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\SermonController@destroy',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.sermons.toggle-featured' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dashboard/sermons/{sermon}/toggle-featured',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\SermonController@toggleFeatured',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\SermonController@toggleFeatured',
        'as' => 'dashboard.sermons.toggle-featured',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.ministries.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/ministries',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.ministries.index',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\MinistryController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\MinistryController@index',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.ministries.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/ministries/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.ministries.create',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\MinistryController@create',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\MinistryController@create',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.ministries.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dashboard/ministries',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.ministries.store',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\MinistryController@store',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\MinistryController@store',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.ministries.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/ministries/{ministry}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.ministries.show',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\MinistryController@show',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\MinistryController@show',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.ministries.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/ministries/{ministry}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.ministries.edit',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\MinistryController@edit',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\MinistryController@edit',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.ministries.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'dashboard/ministries/{ministry}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.ministries.update',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\MinistryController@update',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\MinistryController@update',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.ministries.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'dashboard/ministries/{ministry}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.ministries.destroy',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\MinistryController@destroy',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\MinistryController@destroy',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.ministries.toggle-active' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dashboard/ministries/{ministry}/toggle-active',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\MinistryController@toggleActive',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\MinistryController@toggleActive',
        'as' => 'dashboard.ministries.toggle-active',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.galleries.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/gallery',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.galleries.index',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\GalleryController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\GalleryController@index',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.galleries.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/gallery/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.galleries.create',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\GalleryController@create',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\GalleryController@create',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.galleries.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dashboard/gallery',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.galleries.store',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\GalleryController@store',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\GalleryController@store',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.galleries.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/gallery/{gallery}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.galleries.show',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\GalleryController@show',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\GalleryController@show',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.galleries.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/gallery/{gallery}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.galleries.edit',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\GalleryController@edit',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\GalleryController@edit',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.galleries.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'dashboard/gallery/{gallery}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.galleries.update',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\GalleryController@update',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\GalleryController@update',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.galleries.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'dashboard/gallery/{gallery}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.galleries.destroy',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\GalleryController@destroy',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\GalleryController@destroy',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.videos.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/videos',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.videos.index',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\VideoController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\VideoController@index',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.videos.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/videos/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.videos.create',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\VideoController@create',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\VideoController@create',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.videos.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dashboard/videos',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.videos.store',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\VideoController@store',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\VideoController@store',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.videos.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/videos/{video}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.videos.show',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\VideoController@show',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\VideoController@show',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.videos.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/videos/{video}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.videos.edit',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\VideoController@edit',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\VideoController@edit',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.videos.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'dashboard/videos/{video}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.videos.update',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\VideoController@update',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\VideoController@update',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.videos.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'dashboard/videos/{video}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.videos.destroy',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\VideoController@destroy',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\VideoController@destroy',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.videos.toggle-featured' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dashboard/videos/{video}/toggle-featured',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\VideoController@toggleFeatured',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\VideoController@toggleFeatured',
        'as' => 'dashboard.videos.toggle-featured',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.videos.toggle-published' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dashboard/videos/{video}/toggle-published',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\VideoController@togglePublished',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\VideoController@togglePublished',
        'as' => 'dashboard.videos.toggle-published',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.events.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/events',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.events.index',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\EventController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\EventController@index',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.events.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/events/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.events.create',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\EventController@create',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\EventController@create',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.events.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dashboard/events',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.events.store',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\EventController@store',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\EventController@store',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.events.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/events/{event}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.events.show',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\EventController@show',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\EventController@show',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.events.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/events/{event}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.events.edit',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\EventController@edit',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\EventController@edit',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.events.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'dashboard/events/{event}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.events.update',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\EventController@update',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\EventController@update',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.events.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'dashboard/events/{event}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.events.destroy',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\EventController@destroy',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\EventController@destroy',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.events.toggle-featured' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dashboard/events/{event}/toggle-featured',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\EventController@toggleFeatured',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\EventController@toggleFeatured',
        'as' => 'dashboard.events.toggle-featured',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.prayer-requests.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/prayer-requests',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\PrayerRequestController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\PrayerRequestController@index',
        'as' => 'dashboard.prayer-requests.index',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.prayer-requests.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/prayer-requests/{prayerRequest}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\PrayerRequestController@show',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\PrayerRequestController@show',
        'as' => 'dashboard.prayer-requests.show',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.prayer-requests.mark-answered' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dashboard/prayer-requests/{prayerRequest}/mark-answered',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\PrayerRequestController@markAnswered',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\PrayerRequestController@markAnswered',
        'as' => 'dashboard.prayer-requests.mark-answered',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.prayer-requests.notes' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dashboard/prayer-requests/{prayerRequest}/notes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\PrayerRequestController@addNotes',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\PrayerRequestController@addNotes',
        'as' => 'dashboard.prayer-requests.notes',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.prayer-requests.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'dashboard/prayer-requests/{prayerRequest}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\PrayerRequestController@destroy',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\PrayerRequestController@destroy',
        'as' => 'dashboard.prayer-requests.destroy',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.contact.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/contact',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ContactController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ContactController@index',
        'as' => 'dashboard.contact.index',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.contact.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/contact/{submission}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ContactController@show',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ContactController@show',
        'as' => 'dashboard.contact.show',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.contact.reply' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dashboard/contact/{submission}/reply',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ContactController@markReplied',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ContactController@markReplied',
        'as' => 'dashboard.contact.reply',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.contact.resolve' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dashboard/contact/{submission}/resolve',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ContactController@markResolved',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ContactController@markResolved',
        'as' => 'dashboard.contact.resolve',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.contact.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'dashboard/contact/{submission}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\ContactController@destroy',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\ContactController@destroy',
        'as' => 'dashboard.contact.destroy',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.leadership.manage-years' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/leadership/manage-years',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@manageYears',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@manageYears',
        'as' => 'dashboard.leadership.manage-years',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.leadership.store-year' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dashboard/leadership/manage-years',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@storeYear',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@storeYear',
        'as' => 'dashboard.leadership.store-year',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.leadership.update-year' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'dashboard/leadership/manage-years/{year}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@updateYear',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@updateYear',
        'as' => 'dashboard.leadership.update-year',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.leadership.toggle-year' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dashboard/leadership/manage-years/{year}/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@toggleYear',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@toggleYear',
        'as' => 'dashboard.leadership.toggle-year',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.leadership.delete-year' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'dashboard/leadership/manage-years/{year}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@deleteYear',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@deleteYear',
        'as' => 'dashboard.leadership.delete-year',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.leadership.manage-titles' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/leadership/manage-titles',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@manageTitles',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@manageTitles',
        'as' => 'dashboard.leadership.manage-titles',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.leadership.store-title' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dashboard/leadership/manage-titles',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@storeTitle',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@storeTitle',
        'as' => 'dashboard.leadership.store-title',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.leadership.update-title' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'dashboard/leadership/manage-titles/{title}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@updateTitle',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@updateTitle',
        'as' => 'dashboard.leadership.update-title',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.leadership.toggle-title' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dashboard/leadership/manage-titles/{title}/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@toggleTitle',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@toggleTitle',
        'as' => 'dashboard.leadership.toggle-title',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.leadership.delete-title' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'dashboard/leadership/manage-titles/{title}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@deleteTitle',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@deleteTitle',
        'as' => 'dashboard.leadership.delete-title',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.leadership.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/leadership',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.leadership.index',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@index',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.leadership.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/leadership/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.leadership.create',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@create',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@create',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.leadership.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dashboard/leadership',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.leadership.store',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@store',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@store',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.leadership.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/leadership/{leadership}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.leadership.show',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@show',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@show',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.leadership.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/leadership/{leadership}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.leadership.edit',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@edit',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@edit',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.leadership.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'dashboard/leadership/{leadership}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.leadership.update',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@update',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@update',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.leadership.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'dashboard/leadership/{leadership}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.leadership.destroy',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@destroy',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@destroy',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.leadership.toggle-active' => 
    array (
      'methods' => 
      array (
        0 => 'PATCH',
      ),
      'uri' => 'dashboard/leadership/{leadership}/toggle-active',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@toggleActive',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\LeadershipController@toggleActive',
        'as' => 'dashboard.leadership.toggle-active',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.group-leadership.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/group-leadership',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.group-leadership.index',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\GroupLeadershipController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\GroupLeadershipController@index',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.group-leadership.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/group-leadership/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.group-leadership.create',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\GroupLeadershipController@create',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\GroupLeadershipController@create',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.group-leadership.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dashboard/group-leadership',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.group-leadership.store',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\GroupLeadershipController@store',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\GroupLeadershipController@store',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.group-leadership.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/group-leadership/{group_leadership}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.group-leadership.show',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\GroupLeadershipController@show',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\GroupLeadershipController@show',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.group-leadership.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/group-leadership/{group_leadership}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.group-leadership.edit',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\GroupLeadershipController@edit',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\GroupLeadershipController@edit',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.group-leadership.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'dashboard/group-leadership/{group_leadership}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.group-leadership.update',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\GroupLeadershipController@update',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\GroupLeadershipController@update',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.group-leadership.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'dashboard/group-leadership/{group_leadership}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'as' => 'dashboard.group-leadership.destroy',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\GroupLeadershipController@destroy',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\GroupLeadershipController@destroy',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.group-leadership.toggle-active' => 
    array (
      'methods' => 
      array (
        0 => 'PATCH',
      ),
      'uri' => 'dashboard/group-leadership/{groupLeadership}/toggle-active',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'editor.or.admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\GroupLeadershipController@toggleActive',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\GroupLeadershipController@toggleActive',
        'as' => 'dashboard.group-leadership.toggle-active',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.users.logs' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/users/logs',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'admin.only',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\UserController@logs',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\UserController@logs',
        'as' => 'dashboard.users.logs',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.users.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/users',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'admin.only',
        ),
        'as' => 'dashboard.users.index',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\UserController@index',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\UserController@index',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.users.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/users/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'admin.only',
        ),
        'as' => 'dashboard.users.create',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\UserController@create',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\UserController@create',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.users.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dashboard/users',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'admin.only',
        ),
        'as' => 'dashboard.users.store',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\UserController@store',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\UserController@store',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.users.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/users/{user}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'admin.only',
        ),
        'as' => 'dashboard.users.show',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\UserController@show',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\UserController@show',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.users.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/users/{user}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'admin.only',
        ),
        'as' => 'dashboard.users.edit',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\UserController@edit',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\UserController@edit',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.users.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'dashboard/users/{user}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'admin.only',
        ),
        'as' => 'dashboard.users.update',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\UserController@update',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\UserController@update',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.users.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'dashboard/users/{user}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'admin.only',
        ),
        'as' => 'dashboard.users.destroy',
        'uses' => 'App\\Http\\Controllers\\Dashboard\\UserController@destroy',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\UserController@destroy',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.users.toggle-active' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dashboard/users/{user}/toggle-active',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'admin.only',
        ),
        'uses' => 'App\\Http\\Controllers\\Dashboard\\UserController@toggleActive',
        'controller' => 'App\\Http\\Controllers\\Dashboard\\UserController@toggleActive',
        'as' => 'dashboard.users.toggle-active',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.register' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'admin.only',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\AuthController@showRegisterForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\AuthController@showRegisterForm',
        'as' => 'dashboard.register',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.register.post' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dashboard/register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'dashboard.auth',
          2 => 'admin.only',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\AuthController@register',
        'controller' => 'App\\Http\\Controllers\\Auth\\AuthController@register',
        'as' => 'dashboard.register.post',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
  ),
)
);
