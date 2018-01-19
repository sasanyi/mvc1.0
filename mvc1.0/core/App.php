<?php
/**
 * Created by PhpStorm.
 * User: HFGHOST
 * Date: 2018. 01. 18.
 * Time: 21:08
 */

namespace webadminv3 {


    class App
    {

        private $controller;
        private $method;
        private $param = array();
        private $debug = false;

        /**
         * App constructor.
         * @param string $controller
         * @param string $method
         * @param null $params
         */

        public function __construct ($controller = "index", $method = "index", $params = null){

            $this->controller = ucfirst($controller);

            if(isset($params)){
                $this->getParameters($params);
            }
            $this->method = $method;
            $this->sendToController();

        }

        /**
         * @param $set
         */
        public function setDebug($set){
            $this->debug = $set;
        }

        /**
         * @param $params
         * @return array
         */
        private function getParameters($params){

            return explode("/",$params);

        }

        /**
         *
         */
        private function sendToController(){
            require_once 'Controller.php';
            $controller = new Controller($this->controller,$this->method,$this->param);

            if($controller->is_DOne()){
                return true;
            }else if($this->debug){
                print_r($controller->get_Errors());
                return false;
            }else{
                echo "Hiba lépett fel!";
                return false;
            }


        }

    }
}