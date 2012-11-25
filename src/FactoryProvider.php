<?php

class FactoryProvider extends Provider implements \Reflectable, \Parametable, \Annotatable {
    private $reflection;
    
    public function reflection() {
        if ($this->reflection === null) {
            $value = $this->value();
            
            $this->reflection = new \ReflectionClass($value);
        }
        
        return $this->reflection->getConstructor();
    }
    
    public function parameters() {
        $parameters = array();
        
        if (!$this->reflection()) {
            return array();
        }
        
        foreach ($this->reflection()->getParameters() as $index=>$parameter) {
            $parameters[$index] = $parameter->getName();
        }
        
        return $parameters;
    }
    
    public function annotation() {
        if (!$this->reflection()) {
            return array();
        }
        
        return \AnnotationParser::Parse($this->reflection()->getDocComment());
    }

    protected function doProvide($keys, $values) {
        return new FactoryInvoker($this, $values, $keys);
    }
}
