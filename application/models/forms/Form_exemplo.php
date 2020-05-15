<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Form_exemplo
 *
 * @author herisson.c.silva
 */
class Form_exemplo extends Form_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

    public function init() {
        $this->addElement("form_hidden", "hidden", array("id" => "hidden"));

        $this->addElement("form_dropdown", "select", array("id" => "select", "class" => "form-control"));
        $selectOptions = array("opcao1" => "Opção 1", "opcao2" => "Opção 2");
        $this->addOptions("select", $selectOptions);

        $this->addElement("form_input", "text", array("id" => "text", "class" => "form-control"));

        $this->addElement("form_upload", "arquivo", array("id" => "arquivo", "class" => "form-control"));


        $this->set_rules("select", "select", "required|min_length[3]", array("required" => "Selecione uma opção"));

        if (empty($_FILES['arquivo']['name']))
            $this->set_rules("arquivo", "arquivo", "required", array("required" => "Selecione o arquivo."));

        return;
    }

}
