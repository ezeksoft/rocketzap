### Setup
```
composer require ezeksoft/rocketzap
```

### Simple Example
```php
<?php

use Ezeksoft\RocketZap\
{SDK as RocketZap, Http, Enum\ProjectType, Exception\CustomerRequiredException};

$rocketzap = RocketZap::SDK('YOUR_ACCESS_TOKEN');
$rocketzap->setSession('YOUR_SESSION');

$rocketzap
    ->setCustomer($rocketzap->customer()->setId(1)->setPhone('5511900000000'))
    ->setMessage($rocketzap->message()->setText("Test message"))
    ->save([ProjectType::INSTANTLY]);

```

### Get Response
```php
<?php
list($instantly) = $rocketzap->getResponses();

$instantly->http
    ->then(function(Http $response) use ($rocketzap) {
        print_r("request: ".$rocketzap->getJson()."\n\n");
        print_r("response text: ".$response->getText());
        print_r("response json: ".$response->getJson());
    })
    ->catch(function(Http $response) {
        print_r($response->getError());
    })
;
```

### Automation Example
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