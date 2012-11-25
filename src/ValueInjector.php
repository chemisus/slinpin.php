<?php

class ValueInjector extends \Injector {
    private $values;
    
    public function __construct($values, $next = null) {
        parent::__construct($next);
        
        $this->values = $values;
    }
    
    protected function doInject($provider, $keys, &$values, &$injected) {
        foreach ($keys as $index=>$key) {
            if (!isset($injected[$index])) {
                if (isset($this->values[$key])) {
                    $values[$index] = $this->values[$key];
                    
                    $injected[$index] = true;
                }
                else {
                    $values[$index] = null;
                }
            }
        }
    }
}
