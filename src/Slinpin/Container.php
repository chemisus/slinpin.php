<?php

namespace Slinpin;

class Container implements Containable {
    private $items = array();
    
    public function get($key) {
        return $this->doGet($this->items, $key);
    }
    
    public function set($key, $value) {
        return $this->doSet($this->items, $key, $value);
    }

    public function has($key) {
        return isset($this->items[$key]);
    }
    
    public function __construct($values=array()) {
        $this->items = $values;
    }
    
    protected function doGet($items, $key) {
        return $items[$key];
    }
    
    protected function doSet(&$items, $key, $value) {
        $items[$key] = $value;
        
        return $this;
    }
}
