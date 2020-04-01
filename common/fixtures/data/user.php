<?php

return [
    [
        'id' => 1,
        'username' => 'admin',
        'access_token' => 'ynRnUMg-Wme1VixHkILkwz4J54EsZyOH',
        'access_token_expiration' => time() + 80000,
        // pass: 12345678
        'password_hash' => '$2y$13$aP6eQ43ZB90.M4qonD6ZB.oe5eDDpvQZv1eVU2yghAVk1rYeQxzW.',
        'password_reset_token' => uniqid('', true),
        'created_at' => '1579854759',
        'updated_at' => '1579854759',
        'email' => 'admin@uep.test',
        'status' => \common\models\User::STATUS_ACTIVE,
        'role' => \common\models\User::ROLE_ADMIN,
    ],
    [
        'id' => 2,
        'username' => 'user1',
        'access_token' => 'ynRnUMg-Wme1VixHkILkwz4J54EsZyOH',
        'access_token_expiration' => time() + 80000,
        // pass: 12345678
        'password_hash' => '$2y$13$aP6eQ43ZB90.M4qonD6ZB.oe5eDDpvQZv1eVU2yghAVk1rYeQxzW.',
        'password_reset_token' => uniqid('', true),
        'created_at' => '1579854759',
        'updated_at' => '1579854759',
        'email' => 'user1@uep.test',
        'status' => \common\models\User::STATUS_ACTIVE,
        'role' => \common\models\User::ROLE_USER,
    ],
];
