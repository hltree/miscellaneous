<?php
$app->addRoutingMiddleware();

$customErrorHandler = function (
    $request,
    Throwable $exception
) use ($app) {

    $response = $app->getResponseFactory()->createResponse();
    return $this->get('view')->render($response, '404.html');
};

$errorHandler = $app->addErrorMiddleware(true, true, true);
$errorHandler->setDefaultErrorHandler($customErrorHandler);

$app->get('/', function ($request, $response) {
    return $this->get('view')->render($response, 'index.html');
})->setName('index');