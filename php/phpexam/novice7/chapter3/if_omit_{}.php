<?php
$variable = 'variable';
// omit
if($variable)
    print "variable is true." . PHP_EOL;
// normal
if($variable) {
    print "variable is true." . PHP_EOL;
}

$variable = false;

// omit
if($variable)
    print "variable is true." . PHP_EOL;
else
    print "variable is false." . PHP_EOL;
