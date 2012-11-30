<?php

namespace Slinpin;

interface Scopable {
    function constant($value);
    
    function variable($method, $values=array(), $keys=null);
    
    function method($method, $values=array(), $keys=null);
    
    function factory($value, $values=array(), $keys=null);
    
    function service($method, $values=array(), $keys=null);
}