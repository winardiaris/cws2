<?php
function add_education_category($education_name,$education_type){
	$available = count_on_tbl("data_education","`education_name`='$education_name'");
	if($available>0){
		return status("duplicate");
	}
	else{
		$q = insert_to_tbl("data_education","`education_name`,`education_type`","'$education_name','$education_type'",null);
		////disini masukin skrip untuk create table
		$qry = "CREATE TABLE `data_education_".$education_name."` (`id` int(11) PRIMARY KEY AUTO_INCREMENT,`data` VARCHAR(50),`c_at` DATETIME, `u_at` DATETIME ) ; ";
		$qq = exec_qry($qry,null);
		
		$qry2 = "ALTER TABLE  `personal_education` ADD `data_education_".$education_name."` TEXT NOT NULL AFTER  `u_at` ;";
		$qry3 ="ALTER TABLE  `personal_education` CHANGE `c_at` `c_at` DATETIME NOT NULL AFTER `data_education_".$education_name."`;";
		$qry4 = "ALTER TABLE  `personal_education` CHANGE `u_at` `u_at` DATETIME NOT NULL AFTER `c_at`;";
		exec_qry($qry2,null);
		exec_qry($qry3,null);
		exec_qry($qry4,null);
		
		if($q==true && $qq==true){
			return status("success");
		}
		else{
			return status("error");
		}
	}
	
}
function delete_education_category($education_name){
	$q = delete_data_tbl("data_education"," `education_name`='$education_name' ",null);
	$qq = delete_tbl("data_education_".$education_name);
	
	
	$qry = "ALTER TABLE `personal_education` DROP `data_education_".$education_name."`;";
	exec_qry($qry,null);
	
	if($q==true && $qq==true){
		return status("success");
	}
	else{
			return status("error");
	}
}	
function get_education_list(){
	$education = select_tbl("data_education");
	$json = json_encode($education);
	return $json;
}
function get_education_data_list($table){
	$education = select_tbl($table);
	$json = json_encode($education);
	return $json;
}

function add_education_data($table,$data){
	$available = count_on_tbl($table,"`data`='$data'");
	if($available>0){
		return status("duplicate");
	}
	else{
		$q = insert_to_tbl($table,"`data`","'$data'");
		if($q==true){
			return status("success");
		}
		else{
			return status("error");
		}
	}
	
}
function delete_education_data($table,$id){
	$where = "`id`='$id'";
	$q = delete_data_tbl($table,$where);
	
	if($q==true){
		return status("success");
	}
	else{
		return status("error");
	}
}

?>
