<?php

class Injector {
    private $next;
    
    public function next() {
        return $this->next;
    }
    
    public function __construct($next=null) {
        $this->next = $next;
    }
    
    public function inject($provider, $keys, &$values, &$injected) {
        if ($this->next()) {
            $this->next()->inject($provider, $keys, $values, $injected);
        }

        $this->doInject($provider, $keys, $values, $injected);
    }
    
    protected function doInject($provider, $keys, &$values, &$injected) {
    }
}
