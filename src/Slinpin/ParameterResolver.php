<?php

namespace Slinpin;

class ParameterResolver implements Resolvable {
    private $value;
    
    private $cached = false;
    
    private $keys;
    
    public function __construct(Paramable $value) {
        $this->value = $value;
    }
    
    public function keys() {
        if (!$this->cached) {
            $this->keys = array();
            
            foreach ($this->value->parameters() as $parameter) {
                $this->keys[] = $parameter->getName();
            }
            
            $this->cached = true;
        }
        
        return $this->keys;
    }
}
