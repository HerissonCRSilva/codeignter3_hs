<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Acl
 *
 * @author herisson.c.silva
 */
class Acl {

    private $CI;

    public function __construct() {
        $this->CI = & get_instance();
    }
}
