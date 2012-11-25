<?php

class Scope {
    private $values = array();
    
    public function get($key) {
        if (!isset($this->values[$key])) {
            return null;
        }
        
        return $this->values[$key]->provide();
    }
    
    public function set($key, $value) {
        $this->values[$key] = $value;
    }
    
    public function constant($value, $values=array()) {
        return new \ConstantProvider(null, null, $value);
    }
    
    public function variable($value, $values=array()) {
        return new VariableProvider(
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
        );
    }
    
    public function method($value, $values=array()) {
        return new MethodProvider(
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
        );
    }
    
    public function factory($value, $values=array()) {
        return new FactoryProvider(
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
        );
    }

    public function service($value, $values=array()) {
        return new ServiceProvider(
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
        );
    }
}
