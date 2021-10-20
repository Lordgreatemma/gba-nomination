<?php 

include_once 'includes/autoload.inc.php';
if($_SERVER['REQUEST_METHOD'] == 'POST') 
{
	$data_Obj = new DataAuth();

	$user_value = trim($_POST["user_value"]);
	$nominee_name = ucwords(htmlspecialchars(htmlentities(trim(strip_tags($_POST["first_name"].' '.$_POST["last_name"]))))) ;
	$email = trim(strtolower($_POST["email"]));
	$mobile_number = ucwords(htmlspecialchars(htmlentities(trim(strip_tags($_POST["mobile_number"])))));
	$nominee_bio = htmlspecialchars(htmlentities(trim(strip_tags($_POST["nominee_bio"]))));
	$instagram = htmlspecialchars(htmlentities(trim(strip_tags($_POST["instagram"]))));
	$facebook = htmlspecialchars(htmlentities(trim(strip_tags($_POST["facebook"]))));
	$other = htmlspecialchars(htmlentities(trim(strip_tags($_POST["other"]))));
	$company_details = htmlspecialchars(htmlentities(trim(strip_tags($_POST["company_details"]))));
	$comapny_bio = htmlspecialchars(htmlentities(trim(strip_tags($_POST["comapny_bio"]))));
	$company_instagram = htmlspecialchars(htmlentities(trim(strip_tags($_POST["company_instagram"]))));
	$company_facebook = htmlspecialchars(htmlentities(trim(strip_tags($_POST["company_facebook"]))));
	$company_other = htmlspecialchars(htmlentities(trim(strip_tags($_POST["company_other"]))));
	$company_name = htmlspecialchars(htmlentities(trim(strip_tags($_POST["company_name"]))));
	$phone_number = htmlspecialchars(htmlentities(trim(strip_tags($_POST["phone_number"]))));
	$company_email = trim(strip_tags(strtolower($_POST["company_email"])));

	$category = trim(strip_tags($_POST["category"]));

	$hairstylist_bridal_description1 = htmlspecialchars(htmlentities(trim(strip_tags($_POST["hairstylist_bridal_description1"]))));
	$hairstylist_bridal_description2 = htmlspecialchars(htmlentities(trim(strip_tags($_POST["hairstylist_bridal_description2"]))));
	$hairstylist_editorial_description1 = htmlspecialchars(htmlentities(trim(strip_tags($_POST["hairstylist_editorial_description1"]))));
	$hairstylist_editorial_description2 = htmlspecialchars(htmlentities(trim(strip_tags($_POST["hairstylist_editorial_description2"]))));
	$hairstylist_redcarpet_description1 = htmlspecialchars(htmlentities(trim(strip_tags($_POST["hairstylist_redcarpet_description1"]))));
	$hairstylist_redcarpet_description2 = htmlspecialchars(htmlentities(trim(strip_tags($_POST["hairstylist_redcarpet_description2"]))));
	$hairstylist_bridal_link1 = htmlspecialchars(htmlentities(trim(strip_tags($_POST["hairstylist_bridal_link1"]))));
	$hairstylist_bridal_link2 = htmlspecialchars(htmlentities(trim(strip_tags($_POST["hairstylist_bridal_link2"]))));
	$hairstylist_editorial_link1 = htmlspecialchars(htmlentities(trim(strip_tags($_POST["hairstylist_editorial_link1"]))));
	$hairstylist_editorial_link2 = htmlspecialchars(htmlentities(trim(strip_tags($_POST["hairstylist_editorial_link2"]))));
	$hairstylist_redcarpet_link1 = htmlspecialchars(htmlentities(trim(strip_tags($_POST["hairstylist_redcarpet_link1"]))));
	$hairstylist_redcarpet_link2 = htmlspecialchars(htmlentities(trim(strip_tags($_POST["hairstylist_redcarpet_link2"]))));

	$duplicates = 0; //$data_Obj->duplicates_check("hair_stylist", $nominee_name, $email, $mobile_number, $category);

	// var_dump($duplicates);
	if (trim($duplicates) == 0) 
	{
		$result = $data_Obj->save_hair_stylist_nomination($user_value, $category, $nominee_name, $email, $mobile_number, $nominee_bio, $instagram, $facebook, $other, $company_details, $comapny_bio, $company_instagram, $company_facebook, $company_other, $company_name, $phone_number, $company_email, $hairstylist_bridal_description1, $hairstylist_bridal_description2, $hairstylist_editorial_description1, $hairstylist_editorial_description2, $hairstylist_redcarpet_description1, $hairstylist_redcarpet_description2, $hairstylist_bridal_link1, $hairstylist_bridal_link2, $hairstylist_editorial_link1, $hairstylist_editorial_link2, $hairstylist_redcarpet_link1, $hairstylist_redcarpet_link2);
		if (trim($result > 0)) {

			//SMS ALERT HERE>>>>>>>>>>>
			$valid_mobile = $data_Obj->confirm_mobile_number($mobile_number);
			$valid_mobile2 = $data_Obj->confirm_mobile_number($phone_number);

			if ($valid_mobile == "OK") {
				$data_Obj->user_sms_alert($mobile_number, $_POST["first_name"], $category);
			} elseif($valid_mobile2 == "OK") {
				$data_Obj->user_sms_alert($phone_number, $_POST["first_name"], $category);
			}else{
				// echo "invalid";
			}

			// MAIL ALERT>>>>>>>>>>>>>>
			$data_Obj->send_user_email_alert($_POST["first_name"], $email, $category);

			
			// submission alert to user>>>>>>>>>>>>>>>>>>>>>>>>>>>>
			$response['success'] = true;
            $response["message"] = 'Nomination completed successfully. All the best...!';

            header('Content-Type: application/json');
            echo json_encode($response);
		} else {
			$response['success'] = false;
            $response["message"] = 'Record submission failed, kindly check all your entries and try again.';

            header('Content-Type: application/json');
            echo json_encode($response);
		}
		
	} else {
		$response['success'] = false;
    	$response["message"] = 'There is an entry for this nominee already under the chosen category...!';

        header('Content-Type: application/json');
	    echo json_encode($response);
	}
	
}
	