<?php
require_once './vendor/autoload.php';

$imagesApi = new \src\Apis\ImagesApi(
    new \src\Decorator\LogDecorator(
        new \src\Decorator\LogDecorator(
            new \src\Clients\GuzzleAdapter()
        )
    )
);

$categoriesApi = new src\Apis\CategoriesApi(new \src\Clients\GuzzleAdapter());

print_r($categoriesApi->list());