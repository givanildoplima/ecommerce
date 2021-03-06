<?php

namespace Hcode;

use Rain\Tpl;

class Page
{
 
    private $tpl;
    private $opts = [];
    private $defaults = [
        "data"=>[]
    ];


        public function __construct($opts = array()){
            $this->options = array_merge($this->defaults,$opts);
        $config = array(
            "tpl_dir"       => $_SERVER["DOCUMENT_ROOT"]."/views/",
            "cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
            "debug"         => false // set to false to improve the speed
           );

        Tpl::configure( $config );   
        $this->tpl = new Tpl;
        $this->setData($this->options["data"]);
        $this->tpl->draw("reader");
     }
        


      
        private function setData($data = array()){
            foreach ($data as $key => $value) {
                $this->tpl->assign($key, $value);
             }

        }
    public function setTpl($nome, $data = array(), $returnHTML = false)
    {
        $this->setData();
       return $this->tpl->draw($nome, $returnHTML);

    }

    public function __destruct(){
        $this->tpl->draw("footer");
        
    }
}



?>