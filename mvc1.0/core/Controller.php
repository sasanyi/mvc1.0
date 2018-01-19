<?php
/**
 * Created by PhpStorm.
 * User: HFGHOST
 * Date: 2018. 01. 18.
 * Time: 21:13
 */

namespace webadminv3 {


    class Controller
    {

        private $errors = array();
        private $done = false;
        /**
         * Controller constructor.
         * @param $controller_name
         * @param $method
         * @param array $params
         */
        public function __construct($controller_name, $method, $params=array())
        {
            $this->call_Controller($controller_name,$method,$params);
            print_r($this->get_Errors());

            echo $controller_name;
        }

        /**
         * @param $name
         * @param $method
         * @param $params
         * @return bool
         */
        public function call_Controller($name, $method, $params){
            if(file_exists('../controller/'.$name.'.php')){
                require_once '../controller/'.$name.'.php';
                if(class_exists($name)){
                    if (!empty($name)) {
                        /** @var TYPE_NAME $controller */

                        $controller = new $name();
                    }
                    if(method_exists($controller,$method)){
                        $reflection = new \ReflectionMethod($controller,$method);
                        $args = $reflection->getParameters();
                        if($num = count($args) == count($params)){
                            $controller->$method($params);
                            $this->done = true;
                            return true;
                        }else{
                            $this->add_Error("{$method} have to give {$num} parameters!");
                            $this->done = false;
                            return false;
                        }
                    }else{
                        $this->add_Error("{$method} method not found in {$name} controller!");
                        $this->done = false;
                        return false;
                    }
                }else{
                    $this->add_Error("The controller name is not right!");
                    $this->done = false;
                    return false;
                }

            }else{
                $this->add_Error("This controller not found!");
                $this->done = false;
                return false;
            }

            $this->done = false;
            return false;
        }

        /**
         * @param $model_name
         * @return bool
         */
        public function call_Model($name,$method,$params=array()){
            if(file_exists('../model/'.$name.'.php')){
                require_once '../model/'.$name.'.php';
                if(class_exists($name)){
                    if (!empty($name)) {
                        /** @var TYPE_NAME $model */

                        $model = new $name();
                    }
                    if(method_exists($model,$method)){
                        $reflection = new \ReflectionMethod($model,$method);
                        $args = $reflection->getParameters();
                        if($num = count($args) == count($params)){
                            $model->$method($params);
                            $this->done = true;
                            return true;
                        }else{
                            $this->add_Error("{$method} have to give {$num} parameters!");
                            $this->done = false;
                            return false;
                        }
                    }else{
                        $this->add_Error("{$method} method not found in {$name} model!");
                        $this->done = false;
                        return false;
                    }
                }else{
                    $this->add_Error("The model name is not right!");
                    $this->done = false;
                    return false;
                }

            }else{
                $this->add_Error("This model not found!");
                $this->done = false;
                return false;
            }

            $this->done = false;
            return false;
        }
        private function add_Error($error_message){

            return $this->errors[] = $error_message;

        }

        public function get_Errors(){

            if(count($this->errors) > 0){
                return $this->errors;
            }else{
                return 0;
            }
        }

        public function is_DOne(){
            return $this->done;
        }
    }
}