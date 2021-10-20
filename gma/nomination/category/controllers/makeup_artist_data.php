<?php 

include_once 'includes/autoload.inc.php';
if($_SERVER['REQUEST_METHOD'] == 'GET') 
{
	$data_Obj = new DataAuth();
	$response = array();
    $statsArray = array();
	$user_value = $_GET['user'];
	$category = $_GET['category'];


	$nominee_name = "";
	 $email = "";
	$mobile_number = ""; $nominee_bio = ""; $instagram = ""; $facebook = ""; $other = "";  $company_details = ""; $comapny_bio = ""; $company_instagram = ""; $company_facebook = ""; $company_other = ""; $company_name = ""; $phone_number = ""; $company_email = ""; $photo_description = ""; $special_effect_print = ""; $theatre_description = ""; 
	$social_media_description = "";

	foreach ($data_Obj->load_submitted_record("makeup_artist", $user_value, $category) as $value) {
		$nominee_name = $value['nominee_name'];
		$email = $value['email'];
		$mobile_number = $value['mobile_number']; 
		$nominee_bio = $value['nominee_bio'];
		$instagram = $value['instagram'];
		$facebook = $value['facebook'];
		$other = $value['other'];  
		$company_details = $value['company_details']; 
		$comapny_bio = $value['comapny_bio']; 
		$company_instagram = $value['company_instagram']; 
		$company_facebook = $value['company_facebook']; 
		$company_other = $value['company_other']; 
		$company_name = $value['company_name']; 
		$phone_number = $value['phone_number']; 
		$company_email = $value['company_email']; 


		$photo_link1 = $value['photo_link1'];
		$makeupart_description1 = $value['makeupart_description1']; 
		$photo_link2 = $value['photo_link2'];
		$makeupart_description2 = $value['makeupart_description2']; 
		$photo_editorial_link1 = $value['photo_editorial_link1'];
		$editorial_description1 = $value['editorial_description1'];
		$photo_editorial_link2 = $value['photo_editorial_link2']; 
		$editorial_description2 = $value['editorial_description2'];
		$photo_bridal_link1 = $value['photo_bridal_link1'];
		$bridal_work_description1 = $value['bridal_work_description1'];
		$photo_bridal_link2 = $value['photo_bridal_link2'];
		$bridal_work_description2 = $value['bridal_work_description2'];
	}


	// $valid_mobile = $data_Obj->confirm_mobile_number($mobile_number);
	// $valid_mobile2 = $data_Obj->confirm_mobile_number($phone_number);

	// if ($valid_mobile == "OK") {
	// 	$data_Obj->user_sms_alert($mobile_number, $nominee_name, $category);
	// } elseif($valid_mobile2 == "OK") {
	// 	$data_Obj->user_sms_alert($phone_number, $nominee_name, $category);
	// }else{
	// 	// echo "invalid";
	// }


	$statsArray["nominee_name"] = $nominee_name;
    $statsArray["email"] = $email;
    $statsArray["mobile_number"] = $mobile_number;
    $statsArray["nominee_bio"] = $nominee_bio;
    $statsArray['instagram'] = $instagram;
    $statsArray["facebook"] = $facebook;
    $statsArray["other"] = $other;
    $statsArray["company_details"] = $company_details;
    $statsArray["comapny_bio"] = $comapny_bio;
    $statsArray["company_instagram"] = $company_instagram;
    $statsArray["company_facebook"] = $company_facebook;
    $statsArray["company_other"] = $company_other;
    $statsArray["company_name"] = $company_name;
    $statsArray["phone_number"] = $phone_number;
    $statsArray["company_email"] = $company_email;

    $statsArray["photo_link1"] = $photo_link1;
    $statsArray["makeupart_description1"] = $makeupart_description1;
    $statsArray["photo_link2"] = $photo_link2;
    $statsArray["makeupart_description2"] = $makeupart_description2;
    $statsArray["photo_editorial_link1"] = $photo_editorial_link1;
    $statsArray["editorial_description1"] = $editorial_description1;
    $statsArray["photo_editorial_link2"] = $photo_editorial_link2;
    $statsArray["editorial_description2"] = $editorial_description2;
    $statsArray["photo_bridal_link1"] = $photo_bridal_link1;
    $statsArray["bridal_work_description1"] = $bridal_work_description1;
    $statsArray["photo_bridal_link2"] = $photo_bridal_link2;
    $statsArray["bridal_work_description2"] = $bridal_work_description2;

    $response['success'] = true;
    $response["message"] = 'results loaded';
    $response["data"] = $statsArray;


    header('Content-Type: application/json');
    echo json_encode($response);
}