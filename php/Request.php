<?php

class Request extends Spider
{
    private $referer;
    private $method;
    private $parameters;
    private $url;
    
    public function __construct($cnpj)
    {
        $this->url = 'http://www.sintegra.es.gov.br/resultado.php';
        $this->referer = 'http://www.sintegra.es.gov.br/index.php';
        $this->method = 'POST';
        $this->parameters = array(
            'num_cnpj' => filter_var($cnpj, FILTER_SANITIZE_STRING),
            'num_ie' => '',
            'botao' => 'Consultar',
        );
    }
    
    public function run()
    {
        $output = $this->request($this->url, $this->method, $this->referer, $this->parameters);
        return utf8_encode($output);
    }
}