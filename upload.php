<?php 
include ("static/inc/function/tools.php");
	$unhcr_case_number = ifset('unhcr_case_number2');
			if(isset($unhcr_case_number)){
					if(isset($_FILES['userfile']['tmp_name'])){
						$folder="static/photo/";
						$file_type=$_FILES['userfile']['type'];
							if($file_type=="image/jpeg" || $file_type=="image/jpg" || $file_type=="image/gif"  || $file_type=="image/png"){
								if($_FILES['userfile']['size'] < 10240000){
									$name_file = $unhcr_case_number;
									$photo = $folder.$name_file.".".end(explode(".",$_FILES['userfile']['name']));
									move_uploaded_file($_FILES['userfile']['tmp_name'],$photo);
									
									echo '<script>									
									Element.prototype.remove = function(){ 
										this.parentElement.removeChild(this);
									} 
									NodeList.prototype.remove = HTMLCollection.prototype.remove = function() { 
										for(var i = this.length - 1; i >= 0; i--) {
											if(this[i] && this[i].parentElement) { 
												this[i].parentElement.removeChild(this[i]);
											}
										}
									}
									parent.document.getElementById("upload").innerHTML="<input class=\"form-control\" id=\"photo\" name=\"photo\" value=\"'.$photo.'\" >"
									parent.document.getElementById("photo-pp").setAttribute("src","http://192.168.1.99/cws2/'.$photo.'");
									parent.document.getElementById("unhcr_case_number2").remove();				
									parent.document.getElementById("file").remove();				
									parent.document.getElementById("btnupload").remove();				
									</script>';									
								}
								else{
									echo "<script type='text/javascript'> alert('File size too big. ');</script>";	return false;
								}
							}
							else{
								echo "<script type='text/javascript'> alert('Wrong Filetype [.jpg .gif .png]');</script>";return false;
							}
					}
					else{
						$photo="photo/default.png";
						echo '<script>parent.document.getElementById("upload").innerHTML="<input class=\"form-control\" id=\"photo\" value=\"'.$photo.'\" disabled><br><small class=\"text-success\">Upload failed !!. Photo setup to default</small> "</script>';
					}
			}
			else{
				echo status("Push the unhcr_case_number");
			}
?>



