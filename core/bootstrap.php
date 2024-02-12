<?php

use Core\{Container,Request};
use Core\Database\{Connection, QueryBuilder};

$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

Container::bind('config', require 'config.php');

Container::bind('db', new QueryBuilder(
    Connection::make(Container::get('config')['database'])
));

Container::bind('request_uri', Request::uri());
