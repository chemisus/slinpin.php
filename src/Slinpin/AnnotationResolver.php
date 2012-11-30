<?php

namespace Slinpin;

class AnnotationResolver implements Resolvable {
    const PATTERN = '/@inject\s+(\S+)\s+\$?(\S+)/';

    private $value;

    private $cached = false;

    private $keys;

    private $pattern;

    public function __construct(Annotatable $value, Resolvable $next, $pattern=self::PATTERN) {
        $this->value = $value;

        $this->next = $next;

        $this->pattern = $pattern;
    }

    public function keys() {
        if ($this->cached) {
            return $this->keys;
        }

        $this->keys = $this->resolve();
        
        if ($this->keys === null && $this->next !== null) {
            return $this->next->keys();
        }

        return $this->keys;
    }

    public function resolve() {
        $matches = array();
            
        if (preg_match_all($this->pattern, $this->value->annotation(), $matches)) {
            return array_combine($matches[2], $matches[1]);
        }
        
        return null;
    }
}
