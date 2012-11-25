<?php

class Scope {
    private $values = array();
    
    public function get($key) {
        if (!isset($this->values[$key])) {
            return null;
        }
        
        return $this->values[$key]->provide();
    }
    
    public function provider($key, $value) {
        $this->values[$key] = $value;
    }
    
    public function constant($key, $value, $values=array()) {
        $this->provider($key, new \ConstantProvider(null, null, $value));
    }
    
    public function variable($key, $value, $values=array()) {
        $this->provider($key, new VariableProvider(
            new \AnnotationResolver(
                new \ParameterResolver()
            ),
            new \ValueInjector(
                $values,
                new \ScopeInjector(
                    $this
                )
            ),
            $value
        ));
    }
    
    public function method($key, $value, $values=array()) {
        $this->provider($key, new MethodProvider(
            new \AnnotationResolver(
                new \ParameterResolver()
            ),
            new \ValueInjector(
                $values,
                new \ScopeInjector(
                    $this
                )
            ),
            $value
        ));
    }
    
    public function factory($key, $value, $values=array()) {
        $this->provider($key, new FactoryProvider(
            new \AnnotationResolver(
                new \ParameterResolver()
            ),
            new \ValueInjector(
                $values,
                new \ScopeInjector(
                    $this
                )
            ),
            $value
        ));
    }

    public function service($key, $value, $values=array()) {
        $this->provider($key, new ServiceProvider(
            new \AnnotationResolver(
                new \ParameterResolver()
            ),
            new \ValueInjector(
                $values,
                new \ScopeInjector(
                    $this
                )
            ),
            $value
        ));
    }
}
