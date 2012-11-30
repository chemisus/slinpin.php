<?php

namespace Slinpin;

class Injector implements Injectable {
    private $next;
    
    private $container;
    
    public function __construct(Containable $container, Injectable $next=null) {
        $this->container = $container;
        
        $this->next = $next;
    }
    
    public function inject($keys, $values=array(), $injected=array()) {
        foreach ($keys as $index=>$key) {
            if (!isset($injected[$index]) && $this->container->has($key)) {
                $values[$index] = $this->container->get($key);
                
                $injected[$index] = true;
            }
        }
        
        if ($this->next !== null) {
            return $this->next->inject($keys, $values, $injected);
        }
        
        return $values;
    }
}
