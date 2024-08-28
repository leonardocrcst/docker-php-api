<?php

use App\Infrastructure\Database\Repository\DatabaseRepository;
use App\Package\Common\Repository\DatabaseRepositoryInterface;
use DI\Container;

return function (Container $container) {
    $container->set(
        DatabaseRepositoryInterface::class,
        fn () => new DatabaseRepository()
    );
};
