<?php

require '../vendor/autoload.php';

use PHPShopify\ShopifySDK;

if (isset($_GET)) {
    $SDK = new ShopifySDK([
        'ShopUrl' => 'xn-wbk4a2db6dnc.myshopify.com',
        'AccessToken' => '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'
    ]);
    
    if (isset($_GET['mail_before']) && isset($_GET['mail_after'])) {
        $customers = $SDK->Customer->get();
        if (is_array($customers)) {
            foreach ($customers as $customer) {
                if ($_GET['mail_before'] === $customer['email']) {
                    $SDK->Customer($customer['id'])->put([
                        'email' => $_GET['mail_after']
                    ]);
                }
            }
        }
    }
}
?>
