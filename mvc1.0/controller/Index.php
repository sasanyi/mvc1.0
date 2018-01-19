<?php

/**
 * Created by PhpStorm.
 * User: HFGHOST
 * Date: 2018. 01. 18.
 * Time: 21:13
 */

namespace webadminv3 {

    class Index extends Controller
    {
        /**
         * Index constructor.
         */
        public function __construct(){
            /*Call MODEL*/

            $this->call_Model("Users");
        }
        public function index(){


        }
    }
}