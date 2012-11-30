<?php

namespace Slinpin;

use \ReflectionClass;

class ConstructorInvoker implements Invokable, Paramable, Annotatable {
    private $value;
    
    private $cached = false;
    
    private $reflect;
    
    public function __construct($value) {
        $this->value = $value;
    }
    
    public function invoke($values = array()) {
        return $this->reflect()->newInstanceArgs($values);
    }

    public function reflect() {
        if (!$this->cached) {
            $this->reflect = new ReflectionClass($this->value);
            
            $this->cached = true;
        }
        
        return $this->reflect;
    }
    
    public function parameters() {
        if (!$this->reflect()->getConstructor()) {
            return array();
        }
        
        return $this->reflect()->getConstructor()->getParameters();
    }

    public function annotation() {
        if (!$this->reflect()->getConstructor()) {
            return '';
        }
        
        return $this->reflect()->getConstructor()->getDocComment();
    }
}
