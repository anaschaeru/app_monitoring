<?php

return [
    App\Providers\AppServiceProvider::class,
];

$app->middleware([
    \App\Http\Middleware\RoleMiddleware::class,
]);
