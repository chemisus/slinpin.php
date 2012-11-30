<?php

namespace Slinpin;

interface Injectable {
    function inject($keys, $values=array(), $injected=array());
}
