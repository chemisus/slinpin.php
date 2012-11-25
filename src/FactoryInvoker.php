<?php

class FactoryInvoker {
    private $provider;
    
    private $values;
    
    private $keys;
    
    public function __construct($provider, $values, $keys) {
        $this->provider = $provider;
        
        $this->values = $values;
        
        $this->keys = $keys;
    }
    
    public function invoke($values=array()) {
        $reflection = new \ReflectionClass($this->provider->value());
        
        if ($this->provider->reflection()) {
            return $reflection->newInstanceArgs(array_merge(
                $this->values,
                $values
            ));
        }
        
        return $reflection->newInstanceWithoutConstructor();
    }
}
