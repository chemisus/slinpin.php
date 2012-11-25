<?php

class MethodInvoker {
    private $provider;
    
    private $values;
    
    private $keys;
    
    public function __construct($provider, $values, $keys) {
        $this->provider = $provider;
        
        $this->values = $values;
        
        $this->keys = $keys;
    }
    
    public function invoke($object=null, $locals=array()) {
        $values = $this->values;
        
        foreach ($this->keys as $index=>$key) {
            if (isset($locals[$key])) {
                $values[$index] = $locals[$key];
            }
        }
        
        if ($object === null) {
            $value = $this->provider->value();
            
            $object = $value[0];
        }
        
        return $this->provider->reflection()->invokeArgs($object, $values);
    }
}
