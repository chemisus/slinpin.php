<?php

class ConstantProvider extends Provider {
    protected function doProvide($keys, $values) {
        return $this->value();
    }
}
