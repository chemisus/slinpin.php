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
    
    public function invoke($locals=array()) {
        $values = $this->values;
        
        foreach ($this->keys as $index=>$key) {
            if (isset($locals[$key])) {
                $values[$index] = $locals[$key];
            }
        }
        
        $reflection = new \ReflectionClass($this->provider->value());
        
        if ($reflection) {
            return $reflection->newInstanceArgs($values);
        }
        
        return $reflection->newInstanceWithoutConstructor();
    }
}
