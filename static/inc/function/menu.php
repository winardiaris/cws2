<?php
//menu
function get_menu_list(){
	$data_menu = select_tbl("data_menu","`menu_id`,`menu_name`,`url`,`menu_icon`");
	$json = json_encode($data_menu);
	return $json;
}
function get_submenu_list($menu_id){
	$data_submenu = select_tbl("data_submenu","`submenu_id`,`submenu_name`,`menu_id`,`url`,`submenu_icon`","`menu_id`='$menu_id'");
	$json = json_encode($data_submenu);
	return $json;
}
function get_subsubmenu_list($submenu_id){
	$data_subsubmenu = select_tbl("data_subsubmenu","`subsubmenu_id`,`subsubmenu_name`,`submenu_id`,`url`,`subsubmenu_icon`","`submenu_id`='$submenu_id'");
	$json = json_encode($data_subsubmenu);
	return $json;
}

function add_menu($menu_id,$menu_name,$url,$menu_icon){
	$available_menu = count_on_tbl("data_menu","`menu_id`='$menu_id'");
	if($available_menu>0){
		$return = status("duplicate");
	}
	else{
		$return = insert_to_tbl("data_menu","`menu_id`,`menu_name`,`url`,`menu_icon`","'$menu_id','$menu_name','$url','$menu_icon'");
	}
	return $return;
}

function add_submenu($menu_id,$submenu_id,$submenu_name,$url,$submenu_icon){
	$available_menu = count_on_tbl("data_submenu","`submenu_id`='$submenu_id'");
	if($available_menu>0){
		$return = status("duplicate");
	}
	else{
		$return = insert_to_tbl("data_submenu","`menu_id`,`submenu_id`,`submenu_name`,`url`,`submenu_icon`","'$menu_id','$submenu_id','$submenu_name','$url','$submenu_icon'");
	}
	return $return;
}


?>
