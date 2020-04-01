<?php

return [
    '/' => 'site/index',

    'api/login' => 'api/default/login',

    'GET api/user'             => 'api/user/index',
    'GET api/user/<id:\d+>'    => 'api/user/view',
    'POST api/user'            => 'api/user/create',
    'DELETE api/user/<id:\d+>' => 'api/user/delete',

    'GET api/group'                               => 'api/group/index',
    'GET api/group/<id:\d+>/members'              => 'api/group/members',
    'GET api/group/<id:\d+>/messages'             => 'api/group/messages',
    'POST api/group'                              => 'api/group/create',
    'POST api/group/<id:\d+>/user/<user_id:\d+>'  => 'api/group/add-user',
    'POST api/group/<id:\d+>/message'             => 'api/group/post-message',
    'POST api/group/broad-message'                => 'api/group/broad-message',
];
