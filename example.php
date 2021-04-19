<?php
require_once './vendor/autoload.php';

//$imagesApi = new \src\Apis\ImagesApi(
//    new \src\Decorator\LogDecorator(
//        new \src\Decorator\LogDecorator(
//            new \src\Clients\GuzzleAdapter()
//        )
//    )
//);

$categoriesApi = new src\Apis\CategoriesApi(
    new \src\Decorator\MiddleDecorator(
        new \src\Clients\GuzzleAdapter()
    )
);

print_r($categoriesApi->list());

$categoriesApi = new src\Apis\CategoriesApi(
    new \src\Decorator\MiddleDecorator(
        new \src\Clients\GuzzleAdapter()
    )
);
echo PHP_EOL;
print_r($categoriesApi->list());