<?php

if (!defined('BASEPATH'))
    exit('Nenhum acesso de script direto permitido');

if (!function_exists('verify_key_exists_and_return_identity_value')) {

    
     /**
     * Função para verificar se o índice existe e retorna o valor caso encontre.
     * Caso não encontre, a função permite você retorna um erro padrão.
     * @access public 
     * @author Rodolfo Romão <rodolforomao@gmail.com>
     * @version 0.1 
     * @copyright  GPL © 2019. 
     * @param array, key (a ser validado1), Tipo do Dado (Para retorno do erro)
     * @return Retorna o valor ou o erro.
     */
    function verify_key_exists_and_return_identity_value($array, $key, $dataType = 0)
    {
        if(array_key_exists($key, $array))
        {
            if($array instanceof stdClass )
                return $array->$key;
            else
            return $array[$key];
        }
        else
        {
            // number
            if($dataType == 0)
                return 0;
            else if($dataType == 1)
                return "Sem dados";
            else if($dataType == 2)
                return "Não foi cadatrado nenhum informação para este item.";
            else if($dataType == 3)
                return -1;
            else if($dataType == 4)
                return false;
        }
    }

}
