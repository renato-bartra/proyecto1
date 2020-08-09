<?php

namespace Sample;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

ini_set('error_reporting', E_ALL); // or error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

class PayPalClient
{
    /**
     * Returns PayPal HTTP client instance with environment which has access
     * credentials context. This can be used invoke PayPal API's provided the
     * credentials have the access to do so.
     */
    public static function client()
    {
        return new PayPalHttpClient(self::environment());
    }
    
    /**
     * Setting up and Returns PayPal SDK environment with PayPal Access credentials.
     * For demo purpose, we are using SandboxEnvironment. In production this will be
     * ProductionEnvironment.
     */
    public static function environment()
    {
        $clientId = getenv("CLIENT_ID") ?: "Ac3f106N8efccK3PcaKf5WYl7uA2tSLP9ffv5gqg6wrY0cvQJHbYhf6TZ4BPSPr6wdUZWyufQZNUfsZP";
        $clientSecret = getenv("CLIENT_SECRET") ?: "EGRnfsTX-WP_6euZisPEznP3FCQZvUIEU3bUI81szt8-DHVv1pGwnmwqXau2oc3mdN2iY_icHd7Q5cQ9";
        return new SandboxEnvironment($clientId, $clientSecret);
    }
}
