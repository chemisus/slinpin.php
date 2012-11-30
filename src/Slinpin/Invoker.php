<?php

namespace Slinpin;

class Invoker implements Invokable {
    private $invokable;
    
    public function __construct(Invokable $invokable) {
        $this->invokable = $invokable;
    }
    
    public function invoke($values=array()) {
        return $this->invokable->invoke($values);
    }
}
