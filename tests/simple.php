<?php 

namespace MyApp;

require 'autoload.php';

use Ezeksoft\RocketZap\SDK as RocketZap;
use Ezeksoft\RocketZap\Http;
use Ezeksoft\RocketZap\Enum\ProjectType;
use Ezeksoft\RocketZap\Exception\CustomerRequiredException;

$rocketzap = RocketZap::SDK(env('ACCESS_TOKEN'));
$rocketzap->setSession(env('SESSION'));

require 'tests.php';

$message = $rocketzap->message()
    ->setText("Test message");

// $message = $rocketzap->message();
// $message->setImage(
//     $message->image()
//         ->setUrl("https://site.com/image.png")
//         ->setCaption("My Image.png")
// );

// $message = $rocketzap->message();
// $message->setAttachment(
//     $message->attachment()
//         ->setUrl("https://site.com/invoice.pdf")
//         ->setFilename("BILLING.PDF")
// );

// $message = $rocketzap->message();
// $button = $message->button();
// $message->setButton(
//     $button
//         ->setTitle("Title")
//         ->setMessage("Choose an option:")
//         ->addItem($button->item()->setId("1")->setText("Yes"))
//         ->addItem($button->item()->setId("2")->setText("Not"))
//         ->setFooter("Footer")
// );

try
{
    $rocketzap
        ->setCustomer($rocketzap->customer()->setId(1)->setPhone('5511900000000'))
        ->setMessage($message)
        ->save([ProjectType::INSTANTLY]);

    list($instantly) = $rocketzap->getResponses();

    $instantly->http
        ->then(function(Http $response) use ($rocketzap) {
            print_r("request: ".$rocketzap->getJson()."\n\n");
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