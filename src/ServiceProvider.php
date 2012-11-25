<?php

class ServiceProvider extends Provider implements \Reflectable, \Parametable, \Annotatable {
    private $reflection;
    
    private $cached = false;
    
    private $value;
    
    public function reflection() {
        if ($this->reflection === null) {
            $value = $this->value();
            
            $this->reflection = new \ReflectionFunction($value);
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
        if (!$this->cached) {
            $this->value = $this->reflection()->invokeArgs($values);
            
            $this->cached = true;
        }
        
        return $this->value;
    }
}
