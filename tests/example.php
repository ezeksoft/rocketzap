<?php

namespace MyApp;

use Ezeksoft\RocketZap\SDK as RocketZap;
use Ezeksoft\RocketZap\Enum\{ProjectType, Event};

$rocketzap = RocketZap::SDK('YOUR_ACCESS_TOKEN');

$customer = $rocketzap->customer()
    ->setId(1)
    ->setFirstName('Ezequiel')
    ->setLastName('Moraes')
    ->setEmail('ezequielmoraesdev@gmail.com')
    ->setPhone('5511900000000');

$products = [
    [
        "id" => 50,
        "name" => "Curso de PHP",
        "price" => 197.55
    ]
];

foreach ($products as $product)
{
    $rocketzap->addProduct(
        $rocketzap->product()
            ->setId($product['id'])
            ->setName($product['name'])
            ->setPrice($product['price'])
    );
}

$merchant = $rocketzap->merchant()
    ->setId(1)
    ->setName('RocketPays')
    ->setEmail('suporte@rocketpays.app');

$rocketzap->setPaymentMethod('pix')
    ->setCustomer($customer)
    ->setMerchant($merchant)
    ->setEvent(Event::PIX_GENERATED)
    ->save([ProjectType::AUTOMATION]);

list($automation) = $rocketzap->getResponses();

$type = $automation->type;
$automation->http
    ->then(function($response) use ($type) {
        $json = $response->getJson();
        print_r("type: ". $type."\n");
        print_r("json: ".$json);
    })
    ->catch(function($response) {
        print_r($response->getError());
    })
;