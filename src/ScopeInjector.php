<?php

class ScopeInjector extends \Injector {
    private $scope;
    
    public function __construct($scope, $next = null) {
        parent::__construct($next);
        
        $this->scope = $scope;
    }
    
    protected function doInject($provider, $keys, &$values, &$injected) {
        foreach ($keys as $index=>$key) {
            if (!isset($injected[$index])) {
                $values[$index] = $this->scope->get($key);

                $injected[$index] = true;
            }
        }
    }
}
