<?php

namespace Slinpin;

use \ReflectionMethod;

class MethodInvoker implements Invokable, Paramable, Annotatable {
    private $value;
    
    private $cached = false;
    
    private $reflect;
    
    public function __construct(callable $value) {
        $this->value = $value;
    }
    
    public function invoke($values = array()) {
        return $this->reflect()->invokeArgs($this->value[0], $values);
    }

    public function reflect() {
        if (!$this->cached) {
            $this->reflect = new ReflectionMethod($this->value[0], $this->value[1]);
            
            $this->cached = true;
        }
        
        return $this->reflect;
    }
    
    public function parameters() {
        return $this->reflect()->getParameters();
    }

    public function annotation() {
        return $this->reflect()->getDocComment();
    }
}
