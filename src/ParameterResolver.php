<?php

class ParameterResolver extends \Resolver {
    protected function doResolve($provider, &$keys) {
        if (!($provider instanceof \Parametable)) {
            throw new Exception;
        }
        
        foreach ($provider->parameters() as $index=>$key) {
            $keys[$index] = $key;
        }
    }
}
