<?php
//berkas ini untuk ujicoba skrip
include_once("static/inc/function.php");	
//echo view_user("ars");
$username = "arst";
$password="51df83ac21d3cf136d8341f0b11cb1a7";
$realname = "arst";

$tbl_name= "user";
$where = "`uid`='1'";

$from_table = $tbl_name;


print_r(get_data("username","admin","uid",$from_table));
//~ echo max(array_map("count",$array));
//~ echo $count;
//~ print_r();
//~ echo status("error");


//	$save = insert_to_tbl("user","`username`,`password`","'arst','passwordkosong'");
//	echo $save;

//$arr=array('a'=>1,'b'=>2,'c'=>3,'d'=>4,'e'=>5);
//echo json_encode($arr,JSON_PRETTY_PRINT);
?>
