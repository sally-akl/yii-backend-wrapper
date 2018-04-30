<?php
class LoginController
{
	
	public function Login() {
    
        if (isset($_POST['LoginForm'])) 
		{
			
			$this->sendUrl = Yii::app()->params['remoteServer']."/index.php?r=Users/FrontLogin";
			$this->sendData = array(
					   'LoginForm'=> array(
						  "username"=> $_POST['LoginForm']["username"],
						  "password"=>$_POST['LoginForm']["password"]
					   
					   )
				   );
			$result = $this->sendRequestData();	   
			$result_arr = json_decode($result , true);
			header('content-type: application/json; charset=utf-8');
			if($result_arr["msg"] == "sucess")
			{
				$_SESSION['tokenVal'] = $result_arr["token"];
				$base_path="";
				$base_path = Yii::app()->request->getFullPath();
				echo json_encode(array("msg"=>"sucess","redirect_error" =>$base_path , "token"=>$result_arr["token"]));
               // header("Location:$base_path");
			}
			else
			{
				echo json_encode(array("msg"=>"fail"));
			}
			
			die();
        }
		
		$view = new view();
		$view->render("users/login_tmp.php");
    }
	function sendRequestData()
	{
		$curl = curl_init();
	    curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_URL,  $this->sendUrl);  
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$send_data = http_build_query($this->sendData);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $send_data);
		$result = curl_exec($curl);
		curl_close($curl);
		return $result;
	}
	
	
	
	
	
}


?>
