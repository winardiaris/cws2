<?php
if(isset($_REQUEST['op'])){
	
$address_city = ifset('address_city');
$address_detail = ifset('address_detail');
$address_province = ifset('address_province');
$address_village = ifset('address_village');
$age = ifset('age');
$c_at = ifset('c_at');
$country_id = ifset('country_id');
$country_name = ifset('country_name');
$country_of_origin_id = ifset('country_of_origin_id');
$created = ifset('created');
$data = ifset('data');
$date_arrival = ifset('date_arrival');
$date_of_birth = ifset('date_of_birth');
$education_name = ifset('education_name');
$education_type = ifset('education_type');
$family_relation_id = ifset('family_relation_id');
$file_no = ifset('file_no');
$group_access = ifset('group_access');
$group_id = ifset('group_id');
$group_name = ifset('group_name');
$id = ifset('id');
$last_ip_login = ifset('last_ip_login');
$last_login = ifset('last_login');
$logged = ifset('logged');
$marital = ifset('marital');
$marital_id = ifset('marital_id');
$marital_status_id = ifset('marital_status_id');
$menu_icon = ifset('menu_icon');
$menu_id = ifset('menu_id');
$menu_name = ifset('menu_name');
$person_name = ifset('person_name');
$phone_number = ifset('phone_number');
$photo = ifset('photo');
$port_arrival = ifset('port_arrival');
$region_id = ifset('region_id');
$region_name = ifset('region_name');
$relation = ifset('relation');
$secret_key = ifset('secret_key');
$sex = ifset('sex');
$status = ifset('status');
$submenu_icon = ifset('submenu_icon');
$submenu_id = ifset('submenu_id');
$submenu_name = ifset('submenu_name');
$u_at = ifset('u_at');
$unhcr_case_number = ifset('unhcr_case_number');
$url = ifset('url');
$user_id = ifset('user_id');
$user_info = ifset('user_info');
$user_name = ifset('user_name');
$user_password = md5(ifset('user_password'));
$user_real_name = ifset('user_real_name');
$value = ifset('value');


//-----------------------------------------
$op = ifset('op');
$limit = ifset('limit');
$upload = ifset('upload');
$table = ifset('table');


	
	//user
	if($op=='newuser'){
		echo save_new_user($group_id,$user_name,$user_real_name,$user_password,$user_info);
	}
	elseif($op=='updateuser'){
		echo update_user($user_id,$user_name,$user_password,$user_real_name,$user_info,$secret_key);
	}
	elseif($op=='login'){
		echo user_login($user_name,$user_password);
	}
	elseif($op=='logout'){
		echo user_logout($secret_key);
	}
	elseif($op=='viewuser'){
		echo view_user($secret_key);
	}
	elseif($op=='secret_key_check'){
		echo secret_key_check($secret_key);
	}
	elseif($op=="get_user_secret_key"){
		echo get_user_secret_key($user_name,$user_password);
	}
	elseif($op=="get_user_group_list"){
		echo get_user_group_list();
	}
	elseif($op=="get_user_list"){
		echo get_user_list();
	}
	
	//person
	elseif($op=="get_person_available"){
		echo check_person_available($unhcr_case_number);
	}
	elseif($op=="uploadImage"){
		echo uploadImage($unhcr_case_number);
	}
	elseif($op=="person_save"){
		echo person_save();
	}
	//other
	elseif($op=="get_marital_status_list"){
		echo get_marital_status_list();
	}
	elseif($op=="get_data_family_relation_list"){
		echo get_data_family_relation_list();
	}
	elseif($op=="get_data_country_list"){
		echo get_data_country_list();
	}
	elseif($op=="get_data_region_province"){
		echo get_data_region_province();
	}
	elseif($op=="get_data_region_city"){
		echo get_data_region_city($region_id);
	}
	elseif($op=="get_data_region_village"){
		echo get_data_region_village($region_id);
	}
	//#setting
	//menu
	elseif($op=="get_menu_list"){
		echo get_menu_list();
	}
	elseif($op=="get_submenu_list"){
		echo get_submenu_list($menu_id);
	}
	elseif($op=="add_menu"){
		echo add_menu($menu_id,$menu_name,$url,$menu_icon);
	}
	elseif($op=="add_submenu"){
		echo add_submenu($menu_id,$submenu_id,$submenu_name,$url,$submenu_icon);
	}
	//education setting
	elseif($op=="add_education_category"){
		echo add_education_category($education_name,$education_type);
	}
	elseif($op=="delete_education_category"){
		echo delete_education_category($education_name);
	}
	elseif($op=="get_education_list"){
		echo get_education_list();
	}
	elseif($op=="get_education_data_list"){
		echo get_education_data_list($table);
	}
	elseif($op=="add_education_data"){
		echo add_education_data($table,$data);
	}
	elseif($op=="delete_education_data"){
		echo delete_education_data($table,$id);
	}
	elseif($op=="get_education_with_list"){
		echo get_education_with_list();
	}
	
	
	
	//tool
	elseif($op=="ip"){
		echo get_ip();
	}
	elseif($op=="test"){
		echo generate_controller();
	}

	elseif($op=='get'){
		echo get_data($from_data,$value_data,$select_field,$from_table);
	}
	elseif($op=='check'){
		echo status("koneksi berhasil");
	}
	else{
		//header("location:index.php");
		echo status("no operation");
	}
}
else{
	view("help");
}



?>
