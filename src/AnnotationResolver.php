<?php

class AnnotationResolver extends \Resolver {
    protected function doResolve($provider, &$keys) {
        if (!($provider instanceof \Annotatable)) {
            throw new Exception;
        }
        
        $original = array_values($keys);
        
        foreach ($provider->annotation() as $index=>$key) {
            if (\is_integer($index)) {
                $keys[$index] = $key;
            }
            else {
                $index = \array_search($index, $original, true);
                
                if ($index !== false) {
                    $keys[$index] = $key;
                }
            }
        }
    }
}
