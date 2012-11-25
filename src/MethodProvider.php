<?php

class MethodProvider extends Provider implements \Reflectable, \Parametable, \Annotatable {
    private $reflection;
    
    public function reflection() {
        if ($this->reflection === null) {
            $value = $this->value();
            
            $this->reflection = new \ReflectionMethod($value[0], $value[1]);
        }
        
        return $this->reflection;
    }
    
    public function parameters() {
        $parameters = array();
        
        foreach ($this->reflection()->getParameters() as $index=>$parameter) {
            $parameters[$index] = $parameter->getName();
        }
        
        return $parameters;
    }
    
    public function annotation() {
        return \AnnotationParser::Parse($this->reflection()->getDocComment());
    }

    protected function doProvide($keys, $values) {
        return new MethodInvoker($this, $values, $keys);
    }
}
