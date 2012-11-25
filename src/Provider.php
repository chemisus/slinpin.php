<?php

class Provider {
    private $resolver;
    
    private $injector;
    
    private $value;
    
    public function value() {
        return $this->value;
    }
    
    public function __construct($resolver, $injector, $value) {
        $this->resolver = $resolver;
        
        $this->injector = $injector;
        
        $this->value = $value;
    }
    
    public function resolve() {
        $keys = array();
        
        if ($this->resolver) {
            $this->resolver->resolve($this, $keys);
        }

        return $keys;
    }
    
    public function inject($keys) {
        $values = array();
        
        if ($this->injector) {
            $injected = array();
        
            $this->injector->inject($this, $keys, $values, $injected);
        }
        
        return $values;
    }
    
    public function provide() {
        $keys = $this->resolve();
        
        $values = $this->inject($keys);
        
        return $this->doProvide($keys, $values);
    }
    
    protected function doProvide($keys, $values) {
    }
}
