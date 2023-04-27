<?php 

namespace Ezeksoft\RocketZap;

use Ezeksoft\RocketZap\Http;
use Ezeksoft\RocketZap\Enum\{ProjectType, Event};
use Ezeksoft\RocketZap\Entity\{Customer, Merchant, Product, Pix, Billet};
use Ezeksoft\RocketZap\Exception\{CustomerRequiredException, EventRequiredException, ProductsRequiredException};

class Entity
{
    /** @var string */
    private string $endpoint = "https://rocketzap.app/api";

    /** @var string */
    protected string $api_secret = "";

    /** @var string */
    protected string $payment_method = "";

    /** @var Customer */
    private Customer $customer;

    /** @var Merchant */
    private Merchant $merchant;

    /** @var Product */
    private Product $product;
    
    /** @var array */
    private array $product_list = [];

    /** @var Event */
    private Event $event;
    
    /** @var Pix */
    private Pix $pix;
    
    /** @var Billet */
    private Billet $billet;
    
    /** @var array */
    private array $returns = [];

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
     * Create new pix
     *
     * @return Pix
     */
    public function pix() : Pix
    {
        return new Pix; 
    }

    /**
     * Create new billet
     *
     * @return Billet
     */
    public function billet() : Billet
    {
        return new Billet; 
    }

    /**
     * Set key
     *
     * @param string $api_secret
     * @return Entity
     */
    public function setApiSecret(string $api_secret="") : Entity
    {
        $this->api_secret = $api_secret;
        return $this;
    }

    /**
     * Get key
     *
     * @return string
     */
    protected function getApiSecret() : string
    {
        return $this->api_secret;
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

    /** @return bool */
    public function hasPaymentMethod()
    {
        return !empty($this->payment_method);
    }

    /** @return bool */
    public function hasProducts()
    {
        return !empty($this->product_list);
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

    /** @return bool */
    public function hasCustomer()
    {
        return !empty($this->customer);
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

    /** @return bool */
    public function hasMerchant()
    {
        return !empty($this->merchant);
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
     * Set pix
     *
     * @param Pix $pix
     * @return Entity
     */
    public function setPix(Pix $pix) : Entity
    {
        $this->pix = $pix;
        return $this;
    }

    /**
     * Retrieve pix
     *
     * @return Pix
     */
    public function getPix() : Pix
    {
        return $this->pix;
    }

    /** @return bool */
    public function hasPix()
    {
        return !empty($this->pix);
    }

    /**
     * Set billet
     *
     * @param Billet $billet
     * @return Entity
     */
    public function setBillet(Billet $billet) : Entity
    {
        $this->billet = $billet;
        return $this;
    }

    /**
     * Retrieve billet
     *
     * @return Billet
     */
    public function getBillet() : Billet
    {
        return $this->billet;
    }

    /** @return bool */
    public function hasBillet()
    {
        return !empty($this->billet);
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

    /** @return bool */
    public function hasEvent()
    {
        return !empty($this->event);
    }

    /**
     * Retrieve mapping
     *
     * @return object
     */
    public function getMapping() : object
    {
        if (!$this->hasEvent()) throw new EventRequiredException("Event is required.");
        if (!$this->hasCustomer()) throw new CustomerRequiredException("Customer is required.");
        if (!$this->hasProducts()) throw new ProductsRequiredException("Products are required.");

        $required = [
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
                ]
        ];

        $data = (Object) $required;

        if ($this->hasPaymentMethod()) $this->payment_method = $this->getPaymentMethod();

        if ($this->hasMerchant()) $data->merchant = (Object)
        [
            "id" => $this->merchant->getId(),
            "name" => $this->merchant->getName(),
            "email" => $this->merchant->getEmail()
        ];

        if ($this->hasPix()) $data->pix = (Object)
        [
            "text" => $this->pix->getText(),
            "image" => $this->pix->getImage()
        ];

        if ($this->hasBillet()) $data->billet = (Object)
        [
            "text" => $this->billet->getText(),
            "pdf" => $this->billet->getPdf()
        ];

        return $data;
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