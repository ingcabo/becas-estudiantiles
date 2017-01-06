<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/
$hook['pre_controller'][] = array(
    'class' => 'MyClasses',
    'function' => 'index',
    'filename' => 'MyClasses.php',
    'filepath' => 'hooks'
);


$hook['post_controller_constructor'][] = array(
'class'    => 'PHPExcel',
'function' => '__construct',
'filename' => 'PHPExcel.php',
'filepath' => 'my_classes/Classes/'
);


 ?>
