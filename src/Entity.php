<?php 

namespace Ezeksoft\RocketZap;

use Ezeksoft\RocketZap\Http;
use Ezeksoft\RocketZap\Enum\{ProjectType, Event, PaymentMethod};
use Ezeksoft\RocketZap\Entity\{Customer, Merchant, Product, Pix, Billet, CreditCard, Order, Message};
use Ezeksoft\RocketZap\Exception\{CustomerRequiredException, EventRequiredException, ProductsRequiredException, OrderRequiredException};

class Entity
{
    /** @var string */
    private string $endpoint = "https://dashboard.rocketzap.app/api";

    /** @var string */
    protected string $api_secret = "";

    /** @var string */
    private PaymentMethod $payment_method;

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
    
    /** @var CreditCard */
    private CreditCard $credit_card;
    
    /** @var Order */
    private Order $order;
    
    /** @var Message */
    private Message $message;
    
    /** @var array */
    private array $returns = [];
    
    /** @var string */
    private string $session = "";

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
     * Create new credit card
     *
     * @return CreditCard
     */
    public function creditCard() : CreditCard
    {
        return new CreditCard; 
    }

    /**
     * Create new order
     *
     * @return Order
     */
    public function order() : Order
    {
        return new Order; 
    }

    /**
     * Create new message
     *
     * @return Message
     */
    public function message() : Message
    {
        return new Message; 
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
     * @param PaymentMethod $payment_method
     * @return Entity
     */
    public function setPaymentMethod(PaymentMethod $payment_method) : Entity
    {
        $this->payment_method = $payment_method;
        return $this;
    }

    /**
     * Retrieve payment method
     *
     * @return PaymentMethod
     */
    public function getPaymentMethod() : PaymentMethod
    {
        return $this->payment_method;
    }

    /** @return bool */
    public function hasPaymentMethod() : bool
    {
        return !empty($this->payment_method);
    }

    /** @return bool */
    public function hasProducts() : bool
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
    public function hasCustomer() : bool
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
    public function hasMerchant() : bool
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
    public function hasEvent() : bool
    {
        return !empty($this->event);
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
    public function hasPix() : bool
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
    public function hasBillet() : bool
    {
        return !empty($this->billet);
    }

    /**
     * Set credit card
     *
     * @param CreditCard $credit_card
     * @return Entity
     */
    public function setCreditCard(CreditCard $credit_card) : Entity
    {
        $this->credit_card = $credit_card;
        return $this;
    }

    /**
     * Retrieve credit card
     *
     * @return CreditCard
     */
    public function getCreditCard() : CreditCard
    {
        return $this->credit_card;
    }

    /** @return bool */
    public function hasCreditCard() : bool
    {
        return !empty($this->credit_card);
    }

    /**
     * Set order
     *
     * @param Order $order
     * @return Entity
     */
    public function setOrder(Order $order) : Entity
    {
        $this->order = $order;
        return $this;
    }

    /**
     * Retrieve order
     *
     * @return Order
     */
    public function getOrder() : Order
    {
        return $this->order;
    }

    /** @return bool */
    public function hasOrder() : bool
    {
        return !empty($this->order);
    }

    /**
     * Set session
     *
     * @param string $session
     * @return string
     */
    public function setSession(string $session) : Entity
    {
        $this->session = $session;
        return $this;
    }

    /**
     * Retrieve session
     *
     * @return string
     */
    public function getSession() : string
    {
        return $this->session;
    }

    /** @return bool */
    public function hasSession() : bool
    {
        return !empty($this->session);
    }

    /**
     * Set message
     *
     * @param Message $message
     * @return Message
     */
    public function setMessage(Message $message) : Entity
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Retrieve message
     *
     * @return Message
     */
    public function getMessage() : Message
    {
        return $this->message;
    }

    /** @return bool */
    public function hasMessage() : bool
    {
        return !empty($this->message);
    }

    /**
     * Retrieve mapping
     *
     * @return object
     */
    public function getMapping() : object
    {
        // if (!$this->hasEvent()) throw new EventRequiredException("Event is required.");
        if (!$this->hasCustomer()) throw new CustomerRequiredException("Customer is required.");
        // if (!$this->hasProducts()) throw new ProductsRequiredException("Products are required.");
        // if (!$this->hasOrder()) throw new OrderRequiredException("Order is required.");

        $data = (object) [];

        if ($this->hasOrder()) $data->order = (object)
        [
            "id" => $this->order->getId(),  
            "total" => $this->order->getTotal(),  
        ];
        if ($this->hasProducts()) $data->products = array_map(fn($product) => (object) 
        [
            "id" => $product->getId(),
            "name" => $product->getName(),
            "price" => $product->getPrice()
        ]
        , $this->product_list);
        if ($this->hasEvent()) $data->event = $this->getEvent();
        if ($this->hasCustomer()) $data->customer = (object)
        [
            "id" => $this->customer->getId(),
            "first_name" => $this->customer->getFirstName(),
            "last_name" => $this->customer->getLastName(),
            "name" => $this->customer->getName(),
            "email" => $this->customer->getEmail(),
            "phone" => $this->customer->getPhone()
        ];
        if ($this->hasPaymentMethod()) $data->payment_method = $this->getPaymentMethod()->value;

        if ($this->hasMerchant()) $data->merchant = (object)
        [
            "id" => $this->merchant->getId(),
            "name" => $this->merchant->getName(),
            "email" => $this->merchant->getEmail()
        ];

        if ($this->hasPix()) $data->pix = (object)
        [
            "text" => $this->pix->getText(),
            "image" => $this->pix->getImage()
        ];

        if ($this->hasBillet()) $data->billet = (object)
        [
            "text" => $this->billet->getText(),
            "pdf" => $this->billet->getPdf()
        ];

        if ($this->hasCreditCard()) $data->credit_card = (object)
        [
            "first_six_digits" => $this->credit_card->getFirstSixDigits(),
            "last_four_digits" => $this->credit_card->getLastFourDigits(),
            "flag" => $this->credit_card->getFlag(),
            "installments" => $this->credit_card->getInstallments()
        ];

        if ($this->hasMessage()) $data->message = (object)
        [
            "type" => $this->message->getType(),
            "content" => $this->message->getContent()
        ];

        return $data;
    }

    /**
     * Convert mapping to json
     *
     * @return string
     */
    public function getJson() : string
    {
        return json_encode($this->getMapping());
    }

    /**
     * Dispatch event
     *
     * @param array<ProjectType> $project_types
     * @return Entity
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

                $returns[] = (object)
                [
                    "type" => $project_type->value,
                    "http" => $http
                ];
            }

            if ($project_type == ProjectType::INSTANTLY)
            {
                $http = $this->request(
                    verb: "POST", 
                    resource: "/whatsapp/send", 
                    headers: [
                        "Authorization" => "Bearer ".$this->getApiSecret(),
                        "Content-Type" => "application/json",
                        "Session" => $this->getSession()
                    ],
                    body: $body
                );

                $returns[] = (object)
                [
                    "type" => $project_type->value,
                    "http" => $http
                ];
            }

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
     * @return string
     */
    public function getEndpoint() : string
    {
        return $this->endpoint;
    }

    /**
     * Create an http request
     *
     * @param Mixed ...$arguments
     * @return Http
     */
    private function request(...$arguments) : Http
    {
        return (new Http($this->getEndpoint()))->request(...$arguments);
    }
}