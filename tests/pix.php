<?php

namespace MyApp;

use Ezeksoft\RocketZap\SDK as RocketZap;
use Ezeksoft\RocketZap\Enum\{ProjectType, Event};
use Ezeksoft\RocketZap\Exception\{CustomerRequiredException, EventRequiredException, ProductsRequiredException};

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

$pix = $rocketzap->pix()
    ->setText('1000000000000000000000000')
    ->setImage('data:image/png;base64,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');

try
{
    $rocketzap->setPaymentMethod('pix')
        ->setCustomer($customer)
        ->setMerchant($merchant)
        ->setPix($pix)
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
}

catch (CustomerRequiredException $ex)
{
    echo $ex->getMessage();
}

catch (EventRequiredException $ex)
{
    echo $ex->getMessage();
}

catch (ProductsRequiredException $ex)
{
    echo $ex->getMessage();
}