<?php
if(isset($_REQUEST['op'])){

	include("req.php");
	//-----------------------------------------
	$op = ifset('op');
	$limit = ifset('limit');
	$upload = ifset('upload');
	$table = ifset('table');


	switch ($op) {
		case 'newuser':
			echo save_new_user($group_id,$user_name,$user_real_name,$user_password,$user_info);
			break;

		case 'updateuser':
			  echo update_user($user_id,$user_name,$user_password,$user_real_name,$user_info,$secret_key);
			break;
		case 'login':
			  echo user_login($user_name,$user_password);
			break;
		case 'logout':
			  echo user_logout($secret_key);
			break;
		case 'viewuser':
			  echo view_user($secret_key);
			break;
		case 'secret_key_check':
			  echo secret_key_check($secret_key);
			break;
		case "get_user_secret_key":
			  echo get_user_secret_key($user_name,$user_password);
			break;
		case "get_user_group_list":
			  echo get_user_group_list();
			break;
		case "get_user_list":
			  echo get_user_list();
			break;

			//person
		case "get_person_available":
			  echo check_person_available($unhcr_case_number);
			break;
		case "uploadImage":
			  echo uploadImage($unhcr_case_number);
			break;
		case "person_save":
			  echo person_save();
			break;
		case "person_update":
			  echo person_update();
			break;
		case "person_list":
			  echo person_list();
			break;
		case "person_view":
			  echo person_view();
			break;
		case "add_person_family":
			  echo add_person_family();
			break;
		case "personal_family_members":
			  echo personal_family_members();
			break;
		case "person_comment":
			  echo person_comment();
			break;

			//other
		case "get_marital_status_list":
			  echo get_marital_status_list();
			break;
		case "get_data_family_relation_list":
			  echo get_data_family_relation_list();
			break;
		case "get_data_country_list":
			  echo get_data_country_list();
			break;
		case "get_data_region_province":
			  echo get_data_region_province();
			break;
		case "get_data_region_city":
			  echo get_data_region_city($region_id);
			break;
		case "get_data_region_village":
			  echo get_data_region_village($region_id);
			break;

			//#setting
			//menu
		case "get_menu_list":
			  echo get_menu_list();
			break;
		case "get_submenu_list":
			  echo get_submenu_list($menu_id);
			break;
		case "get_subsubmenu_list":
			  echo get_subsubmenu_list($submenu_id);
			break;
		case "add_menu":
			  echo add_menu($menu_id,$menu_name,$url,$menu_icon);
			break;
		case "add_submenu":
			  echo add_submenu($menu_id,$submenu_id,$submenu_name,$url,$submenu_icon);
			break;

			//education setting
		case "add_education_category":
			  echo add_education_category($education_name,$education_type);
			break;
		case "delete_education_category":
			  echo delete_education_category($education_name);
			break;
		case "get_education_list":
			  echo get_education_list();
			break;
		case "get_education_data_list":
			  echo get_education_data_list($table);
			break;
		case "add_education_data":
			  echo add_education_data($table,$data);
			break;
		case "delete_education_data":
			  echo delete_education_data($table,$id);
			break;
		case "get_education_with_list":
			  echo get_education_with_list();
			break;

			//tool
		case "ip":
			  echo get_ip();
			break;
		case "test":
			  echo generate_controller();
			  // echo calcutateAge("1993-02-02");
			break;
		case 'get':
			  echo get_data($from_data,$value_data,$select_field,$from_table);
			break;
		case 'check':
			  echo status("koneksi berhasil");
			break;

		default:
			echo status("no operation");
			break;
	}
}
else{
	view("help");
}



?>
