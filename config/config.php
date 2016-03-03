<?php
return [
    'root_url' => 'api',
    'allow' => [
        0 => [
            'url' => 'products',
            'method' => 'GET',
            'action' => 'getListAction'
        ],
        1 => [
            'url' => 'cart',
            'method' => 'POST',
            'action' => 'setCartAction'
        ],
        2 => [
            'url' => 'cart',
            'method' => 'DELETE',
            'action' => 'removeCartAction'
        ],
        3 => [
            'url' => 'cart',
            'method' => 'GET',
            'action' => 'getCartAction'
        ]
    ]

];