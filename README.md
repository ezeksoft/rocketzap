### Setup
```
composer require ezeksoft/rocketzap
```

### Example
```php
<?php

use Ezeksoft\RocketZap\SDK as RocketZap;
use Ezeksoft\RocketZap\Enum\{ProjectType, Event, PaymentMethod};

$rocketzap = RocketZap::SDK('YOUR_ACCESS_TOKEN');

$order = $rocketzap->order()
    ->setId(1)
    ->setTotal(149);

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
    ->setName('Seller Name')
    ->setEmail('seller@gmail.com');

$rocketzap
    ->setOrder($order)
    ->setPaymentMethod(PaymentMethod::PIX)
    ->setCustomer($customer)
    ->setMerchant($merchant)
    ->setEvent(Event::PIX_GENERATED)
    ->save([ProjectType::AUTOMATION]);

list($automation) = $rocketzap->getResponses();

$automation->http
    ->then(function($response) {
        echo $response->getText();
    })
    ->catch(function($response) {
        print_r($response->getError());
    })
;

```