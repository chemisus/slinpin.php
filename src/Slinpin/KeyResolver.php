<?php

namespace Slinpin;

class KeyResolver implements Resolvable {
    private $keys;
    
    private $next;
    
    public function __construct(array $keys=null, Resolvable $next=null) {
        $this->keys = $keys;
        
        $this->next = $next;
    }
    
    public function keys() {
        if ($this->keys !== null) {
            return $this->keys;
        }
        
        if ($this->next !== null) {
            return $this->next->keys();
        }
        
        return array();
    }
}
