<?php

class Resolver {
    private $next;
    
    public function next() {
        return $this->next;
    }
    
    public function __construct($next=null) {
        $this->next = $next;
    }
    
    public function resolve($provider, &$keys) {
        if ($this->next()) {
            $this->next()->resolve($provider, $keys);
        }
        
        $this->doResolve($provider, $keys);
    }
    
    protected function doResolve($provider, &$keys) {
    }
}
