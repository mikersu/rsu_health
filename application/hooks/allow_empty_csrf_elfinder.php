<?php  

function allow_empty_csrf_elfinder()
{

    if(stripos($_SERVER["REQUEST_URI"] , '/filemanager/connector' ) !== FALSE)
    {
        $CFG =& load_class('Config', 'core');
        $CFG->set_item('csrf_protection', FALSE);
    }
}


?>