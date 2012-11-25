<?php

class AnnotationParser {
    public static function Parse($subject) {
        $pattern = '/\s*\**\s*@inject\s+(\S+)\s+\$(\S+)/';
        
        $matches = array();
        
        $annotations = array();
        
        if (preg_match_all($pattern, $subject, $matches)) {
            $annotations = array_combine($matches[2], $matches[1]);
        }
        
        return $annotations;
    }
}
