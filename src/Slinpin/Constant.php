<?php

namespace Slinpin;

class Constant implements Providable {
    private $value;
    
    public function __construct($value) {
        $this->value = $value;
    }
    
    public function provide() {
        return $this->value;
    }
}
