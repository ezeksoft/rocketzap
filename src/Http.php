<?php

namespace Ezeksoft\RocketZap;

use Ezeksoft\RocketZap\Serializer;

class Http
{
    private string $endpoint = "";
    private string $response = "";
    private int $errno = 0;
    private string $error = "";
    private string $error_message = "";

    public function __construct(string $endpoint="")
    {
        $this->endpoint = $endpoint;
    }

    public function request(string $verb, string $resource, array $headers=[], string $body="") : Http
    {
        $headers = Serializer::arrayToHeader($headers); 
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->endpoint.$resource);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        if (!empty($body)) curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $verb);
        $response = curl_exec($curl);
        curl_close($curl);
        $errno = curl_errno($curl);
        
        $this->response = $response;
        $this->errno = $errno;
        $this->error = $errno > 0;
        $this->error_message = curl_error($curl);
        return $this;
    }

    public function then(\Closure $callback) : Http
    {
        if (!$this->error)
        {
            $callback($this);
        }

        return $this;
    }

    public function catch(\Closure $callback) : Http
    {
        if ($this->error)
        {
            $callback($this, (Object)
            [
                "status" => "error",
                "message" => $this->error_message
            ]);
        }

        return $this;
    }

    public function finally(\Closure $callback) : Http
    {
        $callback($this);
        return $this;
    }

    public function getError() : string
    {
        return $this->error_message;
    }

    public function getErrorCode() : int
    {
        return $this->errno;
    }

    public function getJson() : string
    {
        return json_encode($this->response ?? '{}');
    }

    public function getText() : string
    {
        return $this->response;
    }
}