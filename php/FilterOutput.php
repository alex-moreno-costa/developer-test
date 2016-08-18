<?php

class FilterOutput
{
    private $output;
    private $dados;
    
    public function __construct($output)
    {
        $this->output = $output;
        $this->sanitize();
    }
    
    private function sanitize()
    {
        $string = preg_replace('/&nbsp;|:/', null, $this->output);
        preg_match_all('/<td.*>(.*)?<\/td>/', $string, $matches);
        
        $this->dados['identificacao'] = array(
            'cnpj' => $matches[1][2],
            'ie' => $matches[1][4],
            'razaoSocial' => $matches[1][6],
            'telefone' => $matches[1][22],
        );
        
        $this->dados['endereco'] = array(
            'logradouro' => $matches[1][8],
            'numero' => $matches[1][10],
            'complemento' => $matches[1][12],
            'bairro' => $matches[1][14],
            'municipio' => $matches[1][16],
            'uf' => $matches[1][18],
            'cep' => $matches[1][20],
        );
        
        $this->dados['informacoesComplementares'] = array(
            'atividadeEconomica' => $matches[1][25],
            'dataDeInicioDeAtividade' => $matches[1][27],
            'situacaoCadastralVigente' => $matches[1][29],
            'dataDestaSituacaoCadastral' => $matches[1][31],
            'regimeDeApuracao' => $matches[1][33],
            'obrigatoriedadeDeEFD' => $matches[1][35],
            'inicioDeObrigatoriedadeDeEFD' => $matches[1][37],
            'emitenteDeNFeDesde' => $matches[1][40],
            'obrigadaANFeEm' => $matches[1][42],
        );
    }
    
    public function getJSON()
    {
        return json_encode($this->dados);
    }
}