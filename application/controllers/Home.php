<?php

use core\controllers\MY_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Home
 *
 * @author herisson.c.silva
 */
class Home extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->template('default', 'home/home', $this->getViewVars());
    }

}
