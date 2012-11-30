<?php

namespace Slinpin;

class Container implements Containable {
    private $values = array();
    
    public function get($key) {
        return $this->doGet($this->values[$key]);
    }
    
    public function set($key, $value) {
        $this->values[$key] = $this->doSet($key, $value);
        
        return $this;
    }

    public function has($key) {
        return isset($this->values[$key]);
    }
    
    public function __construct($values=array()) {
        $this->values = $values;
    }
    
    protected function doGet($value) {
        return $value;
    }
    
    protected function doSet($key, $value) {
        return $value;
    }
}
