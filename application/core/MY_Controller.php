<?php

/**
 * Arquivo de controllers para extenção das demais controllers internas.
 * A função desta biblioteca é fornecer métodos e outros recursos pré-processados para as controllers extensoras.
 *
 * @author Herisson Silva <herisson.dev@gmail.com>
 * @version 1.0 
 * @copyright  GPL © 2019, Accenture | DNIT. 
 * @access public  
 * @package core 
 */

namespace core;

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Classe controller default. 
 * O objetivo desta classe é gerenciar os recursos essenciais e comuns para TODAS as demais controllers.
 *
 * @author Herisson Silva <herisson.dev@gmail.com>
 * @version 1.0 
 * @copyright  GPL © 2019, Accenture | DNIT. 
 * @access public  
 * @package core
 * @subpackage controllers 
 */

namespace core\controllers;

abstract class MY_Controller extends \CI_Controller {

    /**
     * Variável que receberá todos as variáveis à serem trasmitidas para a view.
     * @access private 
     * @name $viewVars 
     */
    private $viewVars = array();

    /**
     * Função para inicializar a classe, carregar suas dependências e setar as definições básicas na $view.
     * @author Herisson Silva <herisson.dev@gmail.com>
     * @version 1.0 
     * @copyright  GPL © 2019, Accenture | DNIT. 
     * @access public  
     * @return void 
     */
    public function __construct() {
        parent::__construct();
        $this->setViewVar('is_ajax', $this->input->is_ajax_request());
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('table_model');
        $this->load->model('form_model');
//        if (empty($this->session->id_usuario)) {
//            redirect(base_url());
//        }
    }

    /**
     * Função para carregar na variável view as variáveis a serem carregadas na view
     * @author Herisson Silva <herisson.dev@gmail.com>
     * @version 1.0 
     * @copyright  GPL © 2019, Accenture | DNIT.
     * @param array $param Array contendo como chave o nome da váriavel a ser carregada na view. 
     * @access public  
     * @return void 
     */
    protected function setViewVars($param) {
        $this->viewVars = $param;
    }

    /**
     * Função para carregar na variável view una variável a ser carregada na view
     * @author Herisson Silva <herisson.dev@gmail.com>
     * @version 1.0 
     * @copyright  GPL © 2019, Accenture | DNIT.
     * @param string $key string contendo como chave o nome da váriavel a ser carregada na view. 
     * @param string $var String com o conteudo da váriavel a ser carregada na view. 
     * @access public  
     * @return void 
     */
    protected function setViewVar($key, $var) {
        $this->viewVars[$key] = $var;
    }

    /**
     * Função para retornar o conteúdo em $view, onde estão as variáveis a serem carregadas na view.
     * @author Herisson Silva <herisson.dev@gmail.com>
     * @version 1.0 
     * @copyright  GPL © 2019, Accenture | DNIT.
     * @access public  
     * @return array 
     */
    protected function getViewVars($key = NULL) {
        return is_null($key) ? $this->viewVars : $this->viewVars[$key];
    }

    /**
     * Função que será executada após todo o processamento da controller e suas dependências.
     * @author Herisson Silva <herisson.dev@gmail.com>
     * @version 1.0 
     * @copyright  GPL © 2019, Accenture | DNIT. 
     * @access public  
     * @return void 
     */
    public function _output($output) {
        echo $output;
        if (!$this->getViewVars()['is_ajax']) {
            
        }
    }

}

/**
 * Classe controller ControllerJWTAuth. 
 * O objetivo desta classe é gerenciar os recursos essenciais e comuns para o WebService.
 *
 * @author Herisson Silva <herisson.dev@gmail.com>
 * @version 1.0 
 * @copyright  GPL © 2019, Accenture | DNIT. 
 * @access public  
 * @package core
 * @subpackage controllers 
 */

namespace core\controllers;

use helpers\JWT;

abstract class ControllerJWTAuth extends MY_Controller {
    /**
     * Variável que receberá todos os parâmetros a serem enviados para a view.
     * @access private 
     * @name $view 
     */

    /**
     * Função para inicializar a classe, carregar suas dependências e setar as definições básicas na $view,
     * promover a validação do token JWT e a autenticação do usuário respectivo.
     * @author Herisson Silva <herisson.dev@gmail.com>
     * @version 1.0 
     * @copyright  GPL © 2019, Accenture | DNIT. 
     * @access public  
     * @return void 
     */
    public function __construct() {
        parent::__construct();

        $this->load->model('tb_users');
        $this->load->model('tb_usuario');
        $this->load->helper('jwt');

        if (!is_null($this->input->get_request_header("token"))) {

            $this->setViewVar('is_ajax', true);

            try {
                $jwt = JWT::decode($this->input->get_request_header("token"), $this->config->item('encryption_key'));
                $log = $this->tb_users->validar_login($jwt->user, md5($jwt->pass));
                if ($log != false) {
                    $this->session->set_userdata($log);
                } else {

                    $this->output
                            ->set_content_type('application/json')
                            ->set_output(json_encode(array("status" => false, "mensagem" => "Usuário não cadastrado ou dados inválidos.")))->_display();
                    exit;
                }
            } catch (\Exception $e) {
                $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array("status" => false, "mensagem" => "Token inválido.")))
                        ->_display();
                exit;
            }
        }

        if (empty($this->session->id_usuario)) {
            if ($this->getViewVars('is_ajax')) {
                $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array("status" => false, "mensagem" => "Usuário não cadastrado ou dados inválidos.")))->_display();
                exit;
            } else {
                redirect(base_url());
            }
        }
    }

    /**
     * Função que será executada após todo o processamento da controller e suas dependências.
     * @author Herisson Silva <herisson.dev@gmail.com>
     * @version 2.0 
     * @copyright  GPL © 2019, Accenture | DNIT. 
     * @access public  
     * @return void 
     */
    public function _output($output) {
        if (!is_null($this->input->get_request_header("token"))) {
//            $this->tb_usuario->finalizaSessao();
            $this->session->sess_destroy();
        }
        echo $output;
    }

}
