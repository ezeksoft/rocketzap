<?php 

namespace Ezeksoft\RocketZap;

use Ezeksoft\RocketZap\Http;
use Ezeksoft\RocketZap\Enum\{ProjectType, Event};
use Ezeksoft\RocketZap\Entity\{Customer, Product, Merchant};

class Entity
{
    /** @var string */
    protected string $apiSecret = "";

    /** @var Customer */
    private Customer $customer;

    /** @var Product */
    private Product $product;

    /** @var Merchant */
    private Merchant $merchant;

    /** @var Event */
    private Event $event;
    
    /** @var array */
    private array $product_list = [];
    
    /** @var array */
    private array $returns = [];

    /**
     * Set key
     *
     * @param string $apiSecret
     * @return Entity
     */
    public function setApiSecret(string $apiSecret="") : Entity
    {
        $this->apiSecret = $apiSecret;
        return $this;
    }

    /**
     * Get key
     *
     * @return string
     */
    protected function getApiSecret() : string
    {
        return $this->apiSecret;
    }

    /**
     * Create new customer
     *
     * @return Customer
     */
    public function customer() : Customer
    {
        return new Customer;
    }

    /**
     * Create new merchant
     *
     * @return Merchant
     */
    public function merchant() : Merchant
    {
        return new Merchant;
    }

    /**
     * Create new product
     *
     * @return Product
     */
    public function product() : Product
    {
        return new Product; 
    }

    /**
     * Set customer
     *
     * @param Customer $customer
     * @return Entity
     */
    public function setCustomer(Customer $customer) : Entity
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * Retrieve customer
     *
     * @return Customer
     */
    public function getCustomer() : Customer
    {
        return $this->customer;
    }

    /**
     * Push product to a list
     *
     * @param Product $product
     * @return Entity
     */
    public function addProduct(Product $product) : Entity
    {
        $this->product_list[] = $product;
        return $this;
    }

    /**
     * Set payment method
     *
     * @param string $payment_method
     * @return Entity
     */
    public function setPaymentMethod(string $payment_method) : Entity
    {
        $this->payment_method = $payment_method;
        return $this;
    }

    /**
     * Retrieve payment method
     *
     * @return string
     */
    public function getPaymentMethod() : string
    {
        return $this->payment_method;
    }

    /**
     * Set merchant
     *
     * @param Merchant $merchant
     * @return Entity
     */
    public function setMerchant(Merchant $merchant) : Entity
    {
        $this->merchant = $merchant;
        return $this;
    }

    /**
     * Retrieve merchant
     *
     * @return Merchant
     */
    public function getMerchant() : Merchant
    {
        return $this->merchant;
    }

    /**
     * Set event
     * eg: pix_generated, approved, canceled, ...
     *
     * @param Event $event
     * @return Entity
     */
    public function setEvent(Event $event) : Entity
    {
        $this->event = $event;
        return $this;
    }

    /**
     * Retrieve event
     *
     * @return Event
     */
    public function getEvent() : Event
    {
        return $this->event;
    }

    /**
     * Retrieve mapping
     *
     * @return object
     */
    public function getMapping() : object
    {
        return (Object)
        [
            "payment_method" => $this->getPaymentMethod(),
            "event" => $this->getEvent(),
            "products" => array_map(fn($product) => 
                (Object) 
                    [
                        "id" => $product->getId(),
                        "name" => $product->getName(),
                        "price" => $product->getPrice()
                    ]
            , $this->product_list),
            "customer" => (Object)
                [
                    "id" => $this->customer->getId(),
                    "first_name" => $this->customer->getFirstName(),
                    "last_name" => $this->customer->getLastName(),
                    "name" => $this->customer->getName(),
                    "email" => $this->customer->getEmail(),
                    "phone" => $this->customer->getPhone()
                ],
            "merchant" => (Object)
                [
                    "id" => $this->merchant->getId(),
                    "name" => $this->merchant->getName(),
                    "email" => $this->merchant->getEmail()
                ]
        ];
    }

    /**
     * Convert mapping to json
     *
     * @return void
     */
    public function getJson()
    {
        return json_encode($this->getMapping());
    }

    /**
     * Dispatch event
     *
     * @param array<ProjectType> $project_types
     * @return void
     */
    public function save(array $project_types) : Entity
    {
        $body = $this->getJson();

        $returns = [];

        foreach ($project_types as $project_type)
        {
            if ($project_type == ProjectType::AUTOMATION)
            {
                $http = $this->request(
                    verb: "POST", 
                    resource: "/integration/rocketpays", 
                    headers: [
                        "Authorization" => "Bearer ".$this->getApiSecret(),
                        "Content-Type" => "application/json"
                    ],
                    body: $body
                );

                $returns[] = (Object)
                [
                    "type" => $project_type->value,
                    "http" => $http
                ];
            }
            
            // if ($project_type == ProjectType::CAMPAIGN)
            // {
            //     // do stuff...
            // }

            $http = null;
        }

        $this->returns = $returns;

        return $this;
    }

    /**
     * Retrieve responses from sending data by tcp
     *
     * @return array<Http>
     */
    public function getResponses() : array
    {
        return $this->returns;
    }

    /**
     * Set endpoint
     *
     * @param string $endpoint
     * @return Entity
     */
    public function setEndpoint(string $endpoint) : Entity
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    /**
     * Retrieve endpoint
     *
     * @return void
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * Create an http request
     *
     * @param Mixed ...$arguments
     * @return void
     */
    private function request(...$arguments) : Http
    {
        return (new Http($this->getEndpoint()))->request(...$arguments);
    }
}