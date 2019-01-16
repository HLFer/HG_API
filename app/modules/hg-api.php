<?php

class HgApi
{
    private $key = null;
    private $err = false;

    function __construct($key)
    {
        if (!empty($key)) {
            $this->key = $key;
        }
    }
    function request($endpoint = '', $params = [])
    {
        $uri = 'https://api.hgbrasil.com/' . $endpoint . '?key=' . $this->key . '&format=json';

        if (is_array($params)) {
            foreach ($params as $key => $value) {
                if (empty($value)) continue;
                else {
                    $uri .= $key . '=' . urlencode($value) . '&';
                }
            }
            $uri = substr($uri, 0, -1);
            $response = @file_get_contents($uri);
            $this->err = false;
            return json_decode($response, true);
        } else {
            $this->err = true;
            return false;
        }
    }
    function isErr()
    {
        return $this->err;
    }
    function dollarQuotation()
    {
        $data = $this->request('finance/quotations');
        if (!empty($data) && is_array($data['results']['currencies']['USD'])) {
            $this->err = false;
            return $data['results']['currencies']['USD'];
        } else {
            $this->err = true;
            return false;
        }
    }
}