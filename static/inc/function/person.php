<?php
function check_person_available($unhcr_case_number){
	$available_person = count_on_tbl("personal_information","`unhcr_case_number`='$unhcr_case_number'");
	if($available_person>0){
		return status("inuse");
	}
	else{
		return status("avail");
	}
}

function person_save(){
	$field_name="";
	$value_data="";
	$request = request();
	foreach($request as $key => $value){
		$field_name .="`$key`,";
		$value_data .="'$value',";
	}
	$field_name = substr($field_name,0,-1);
	$value_data = substr($value_data,0,-1);
	
	
	$available_person = count_on_tbl("personal_information","`unhcr_case_number`='$unhcr_case_number'");
	if($available_person>0){
		return status("duplicate");
	}
	else{
		$q = insert_to_tbl("personal_information",$field_name,$value_data);
			if($q==true){
				return status("success");
			}else{
				return status("error");
			}
	}
}


?>
