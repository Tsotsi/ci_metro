<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ReflectItem{
    /**
     *
     * @var type /public[ \t]+function[ \t]+action([A-Z]{1}[a-zA-Z0-9]+)[ \t]*\(/
     */
    private  $_arr=array();
    private $_methods=array();
    public function __construct()
    {
        if(empty($this->_arr)){
        $this->init();
        }
        return $this;
    }
    public  function  init()
    {
        $dir=APPPATH.'controllers/';
        $this->itemWalker($dir);
    }
    public  function  itemWalker($dir)
    {
        
        foreach(glob($dir.'*') as $f){
            if(is_file($f)){
    array_push($this->_arr, $f);
            }else{
                $this->itemWalker($f.'/');
            }
        }
        $this->_getActions();
    }
    private function _getActions()
    {
        
        foreach($this->_arr as $f){
            if(is_file($f)&&  preg_match('/[\/\\\](\w+)\.php$/i', $f,$m)){
  
            }
        }
    }
    public function getClass()
    {
        return $this->_arr;
    }
    public function getMethods()
    {
        return $this->_methods;
    }
}