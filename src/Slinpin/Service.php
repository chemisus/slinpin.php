<?php

namespace Slinpin;

class Service implements Providable {
    private $method;
    
    private $cached = false;
    
    public function __construct(Method $method) {
        $this->method = $method;
    }
    
    public function provide() {
        if (!$this->cached) {
            $this->value = $this->method->invoke();
            
            $this->cached = true;
        }
        
        return $this->value;
    }
}
