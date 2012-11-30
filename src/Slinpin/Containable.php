<?php

namespace Slinpin;

interface Containable {
    function get($key);
    
    function has($key);
}
