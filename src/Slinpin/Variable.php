<?php

namespace Slinpin;

class Variable implements Providable {
    private $method;
    
    public function __construct(Method $method) {
        $this->method = $method;
    }
    
    public function provide() {
        return $this->method->invoke();
    }
}
