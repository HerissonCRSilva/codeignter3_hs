<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Table_example extends Table_model {
    //nome da tabela no banco
    protected $table = '';

    public function __construct() {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }

    public function getModel() {

        $return = $this->db->query("");
        if ($return != false) {
            return $return->result_array();
        } else {
            return false;
        }
    }
}
