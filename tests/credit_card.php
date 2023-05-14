<?php 

namespace MyApp;

require 'autoload.php';

use Ezeksoft\RocketZap\SDK as RocketZap;
use Ezeksoft\RocketZap\Http;
use Ezeksoft\RocketZap\Enum\{ProjectType, Event, PaymentMethod};
use Ezeksoft\RocketZap\Exception\{CustomerRequiredException, EventRequiredException, ProductsRequiredException, OrderRequiredException};

$rocketzap = RocketZap::SDK(env('ACCESS_TOKEN'));

require 'tests.php';

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

$credit_card = $rocketzap->creditCard()
    ->setFirstSixDigits("454545")
    ->setLastFourDigits("0123")
    ->setFlag("visa")
    ->setInstallments(6);

$order = $rocketzap->order()
    ->setId(1)
    ->setTotal(149);

try
{
    $rocketzap
        ->setOrder($order)
        ->setPaymentMethod(PaymentMethod::CREDIT_CARD)
        ->setCustomer($customer)
        ->setMerchant($merchant)
        ->setCreditCard($credit_card)
        ->setEvent(Event::APPROVED) // or Event::REJECTED or Event::PENDING
        ->save([ProjectType::AUTOMATION]);

    list($automation) = $rocketzap->getResponses();

    $type = $automation->type;
    $automation->http
        ->then(function(Http $response) use ($type, $rocketzap) {
            $json = $response->getJson();
            print_r("type: ". $type."\n\n");
            print_r("request: ". $rocketzap->getJson()."\n\n");
            print_r("response: ".$response->getText());
        })
        ->catch(function(Http $response) {
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

catch (OrderRequiredException $ex)
{
    echo $ex->getMessage();
}