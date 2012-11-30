<?php

namespace Slinpin;

use \ReflectionFunction;

class FunctionInvoker implements Invokable, Paramable, Annotatable {
    private $value;
    
    private $cached = false;
    
    private $reflect;
    
    public function __construct(callable $value) {
        $this->value = $value;
    }
    
    public function invoke($values = array()) {
        return $this->reflect()->invokeArgs($values);
    }

    public function reflect() {
        if (!$this->cached) {
            $this->reflect = new ReflectionFunction($this->value);
            
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
