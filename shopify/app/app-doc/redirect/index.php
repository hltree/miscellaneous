<?php
require '../vendor/autoload.php';

use PHPShopify\AuthHelper;
use PHPShopify\ShopifySDK;

new ShopifySDK([
    'ShopUrl' => 'xn-wbk4a2db6dnc.myshopify.com',
    'ApiKey' => '8ee69e5b421081c4047ebbf579ab74e1',
    'SharedSecret' => 'a7c928dc51d491c53159f8d82fc1b66e'
]);

$accessToken = AuthHelper::getAccessToken();

echo $accessToken;