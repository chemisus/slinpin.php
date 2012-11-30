<?php

namespace Slinpin;

class Scope extends Container {
    protected function doGet($value) {
        return $value->provide();
    }
    
    protected function doSet($key, Providable $value) {
        if ($this->has($key)) {
            throw new Exception;
        }
        
        return $value;
    }
    
    public function __construct() {
        $this->set('scope', $this->constant($this));

        $this->set('invoke', function ($scope) {
            return function ($key, $values=array()) use ($scope) {
                return $scope->invoke($key, $values);
            };
        });
        
        $this->set('inject', function ($scope) {
            return function ($value, $values=array(), $keys=null) use ($scope) {
                return $scope->method($value, $values, $keys);
            };
        });
        
        $this->set('instance', function ($scope) {
            return function ($value, $values=array(), $keys=null) use ($scope) {
                return $scope->factory($value, $values, $keys);
            };
        });
    }
    
    public function invoker($value, $values=array(), $keys=null) {
        return new Method(
            new Injector(new Container($values),
                new Injector($this)
            ),
            new KeyResolver(
                $keys,
                new AnnotationResolver(
                    $value,
                    new ParameterResolver($value)
                )
            ),
            $value
        );
    }
    
    public function constant($value) {
        return new Constant($value);
    }
    
    public function variable($value, $values=array(), $keys=null) {
        return new Variable($this->method($value, $values, $keys));
    }
    
    public function method($value, $values=array(), $keys=null) {
        if (is_array($value)) {
            $invoker = new MethodInvoker($value);
        }
        else {
            $invoker = new FunctionInvoker($value);
        }
        
        return $this->invoker($invoker, $values, $keys);
    }
    
    public function factory($value, $values=array(), $keys=null) {
        return $this->invoker(new ConstructorInvoker($value), $values, $keys);
    }
    
    public function service($value, $values=array(), $keys=null) {
        return new Service($this->method($value, $values, $keys));
    }
    
    public function invoke($key, $values=array()) {
        return $this->get($key)->invoke($values);
    }
    
    public function inject($method, $values=array(), $keys=null) {
        return $this->method($method, $values, $keys)->invoke();
    }
    
    public function instance($class, $values=array(), $keys=null) {
        return $this->factory($class, $values, $keys)->invoke();
    }
}
