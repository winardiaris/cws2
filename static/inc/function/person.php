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
	unset($request['age']);
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
function person_list(){
	$request = request();
	if(isset($request['secret_key'])){
		$secret_key = $request['secret_key'];
		$is_login = is_login_key($secret_key);
		if($is_login==true){

			if(isset($request['search'])){
				$search = $request['search'];

				$where = "`unhcr_case_number` like '%$search%' or `person_name` like '%$search%' or `address_detail` like '%$search%' ";
			}
			else{
				$where = "1";
			}

			$person_list = select_tbl("personal_information",'`unhcr_case_number`,`person_name`,`date_of_birth`,`country_of_origin_id`,`sex`,`phone_number`,`address_province`,`address_city`,`address_village`,`address_detail`,`status`',$where ,null,null);


			$result = array();
			foreach ($person_list['data'] as $data){
				$key = array();
				$value = array();
				foreach ($data as $key_ => $value_) {
			    array_push($key,$key_);
			    array_push($value,$value_);

			    //change address to name
			    $prov = get_name_region($data['address_province']);
			    $city = get_name_region($data['address_city']);
			    $village = get_name_region($data['address_village']);
			    $age = calcutateAge($data['date_of_birth']);
			    $detail = $data['address_detail'];
			    $address = $detail.", ".$village.", ".$city.", ".$prov;

			    array_push($key,"age");
			    array_push($value,$age);
			    array_push($key,"address");
			    array_push($value,$address);


				}
				$result_ = array_combine($key,$value);
				//~ unset($result_["address_village"]);
				array_push($result,$result_);
			}
			$data = array("data"=>$result);
				return json_encode($data);

		}
		else{
			return status("please login");
		}
	}
	else{
		return status("no secret_key found!");
	}
}

function person_view(){
	$request = request();
	if(isset($request['secret_key'])){
		$secret_key = $request['secret_key'];
		$is_login = is_login_key($secret_key);
		if($is_login==true){

			if(isset($request['unhcr_case_number'])){
				$unhcr_case_number = $request['unhcr_case_number'];

				$where = "`unhcr_case_number`='$unhcr_case_number'";


			$person_list = select_tbl("personal_information",null,$where ,null,null);
			$result = array();
			foreach ($person_list['data'] as $data){
				$key = array();
				$value = array();
				foreach ($data as $key_ => $value_) {
			    array_push($key,$key_);
			    array_push($value,$value_);

			    //change address to name
			    $prov = get_name_region($data['address_province']);
			    $city = get_name_region($data['address_city']);
			    $village = get_name_region($data['address_village']);
			    $age = calcutateAge($data['date_of_birth']);
			    $detail = $data['address_detail'];
			    $address = $detail.", ".$village.", ".$city.", ".$prov;

			    array_push($key,"age");
			    array_push($value,$age);
			    array_push($key,"address");
			    array_push($value,$address);


				}
				$result_ = array_combine($key,$value);
				//~ unset($result_["address_village"]);
				array_push($result,$result_);
			}
			$data = array("data"=>$result);
				return json_encode($data);

			}
			else{
				return status("unhcr_case_number not found!!");
			}
		}
		else{
			return status("no secret_key found!");
		}
	}
}

function add_person_family(){
	$field_name="";
	$value_data="";
	$request = request();

	if(isset($request['secret_key'])){
		$secret_key = $request['secret_key'];
		$is_login = is_login_key($secret_key);
		if($is_login==true){

			unset($request['secret_key']);
			foreach($request as $key => $value){
				$field_name .="`$key`,";
				$value_data .="'$value',";
			}
			$field_name = substr($field_name,0,-1);
			$value_data = substr($value_data,0,-1);


			$available_person = count_on_tbl("personal_family_members","`unhcr_case_number_family`='$unhcr_case_number_family'");
			if($available_person>0){
				return status("duplicate");
			}
			else{
				$q = insert_to_tbl("personal_family_members",$field_name,$value_data);
					if($q==true){
						return status("success");
					}else{
						return status("error");
					}
			}

		}

	}
	else {
		return status("no secret_key found!");
	}


}
function personal_family_members(){
	$request = request();
	if(isset($request['secret_key'])){
		$secret_key = $request['secret_key'];
		$is_login = is_login_key($secret_key);
		if($is_login==true){

			if(isset($request['unhcr_case_number'])){
				$unhcr_case_number = $request['unhcr_case_number'];

				$where = "`unhcr_case_number`='$unhcr_case_number'";


			$person_list = select_tbl("personal_family_members",null,$where ,null,null);
			$result = array();
			foreach ($person_list['data'] as $data){
				$key = array();
				$value = array();
				foreach ($data as $key_ => $value_) {
			    array_push($key,$key_);
			    array_push($value,$value_);

			    // //change family_relation_id to name
			    $relation = get_name_family_relation($data['family_relation_id']);
			    // $city = get_name_region($data['address_city']);
			    // $village = get_name_region($data['address_village']);
			    // $age = calcutateAge($data['date_of_birth']);
			    // $detail = $data['address_detail'];
			    // $address = $detail.", ".$village.", ".$city.", ".$prov;
					//
			    array_push($key,"relation");
			    array_push($value,$relation);
			    // array_push($key,"address");
			    // array_push($value,$address);


				}
				$result_ = array_combine($key,$value);
				//~ unset($result_["address_village"]);
				array_push($result,$result_);
			}
			$data = array("data"=>$result);
				return json_encode($data);

			}
			else{
				return status("unhcr_case_number not found!!");
			}
		}
		else{
			return status("no secret_key found!");
		}
	}
}
?>
