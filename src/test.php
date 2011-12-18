<?php

class test {
    public function _arrayMergeRecursive($mergeInto, $mergeFrom) {
        if (is_array($mergeInto) && is_array($mergeFrom)) {
            foreach ($mergeFrom as $key => $value) {
                if (isset($mergeInto[$key])) {
                    $mergeInto[$key] = $this->_arrayMergeRecursive($mergeInto[$key], $value);
                } else {
                    $mergeInto[$key] = $value;
                }
            }
        } else {
            $mergeInto = $mergeFrom;
        }
        
        return $mergeInto;
    }
}

$t = new test();

var_dump($t->_arrayMergeRecursive(array('this' => 'that'), array(0 => 'foo')));
