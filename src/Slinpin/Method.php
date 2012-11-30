<?php

namespace Slinpin;

class Method implements Providable, Invokable {
    private $method;
    
    private $injector;
    
    private $resolver;
    
    public function __construct(Injectable $values, Resolvable $keys, Invokable $method) {
        $this->method = $method;
        
        $this->injector = $values;
        
        $this->resolver = $keys;
    }
    
    public function provide() {
        return $this;
    }
    
    public function invoke($values = array()) {
        $keys = $this->resolver->keys();
        
        $values = $this->injector->inject($keys, $values);
        
        return $this->method->invoke($values);
    }
}
