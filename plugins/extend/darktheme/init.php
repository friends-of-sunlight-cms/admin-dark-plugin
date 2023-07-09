<?php

use Sunlight\Extend;

Extend::reg('core.javascript', function ($args) {
    $args['variables']['admin']['themeIsDark'] = true;
}, -5);