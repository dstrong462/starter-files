<?php

    // Returns the contents of an svg file
    function get_svg($key) {
        $content = '';
        $file = 'library/svg/'.$key.'.svg';
        if(file_exists($file)) {
            $content = file_get_contents($file);
        } else {
            $content = 'not found';
        }
        return $content;
    }

?>