<?php

return [
    'path' => [
        'public' => str_replace('storage', 'resources', storage_path()) . '/keys/public-key.pem',
        'private' => str_replace('storage', 'resources', storage_path()) . '/keys/private-key.pem'
    ]
];
