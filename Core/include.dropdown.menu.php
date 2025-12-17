<?php

        include '../include/include.php';

        include 'include/session.php';

        $fathercode = $_SESSION["username"];
        $preref_id = $fathercode . "-" . date('d-m-Y-H-i-s');
        $pretrack_id = rand('10', '99') . $fathercode . date('Y') . date('m') . date('d') . date('His');
        //echo $prepayment_id." ".$preref_id." ".$pretrack_id." ".$pretransaction_no;

        $objSmart = new smartSolution();
        $objNotes = new web_app_notes();
        $objTransaction = new web_app_transaction();
        $objOrder = new web_app_order();
        $objSettings = new settings();


//                $arrta=$objTransaction->getAll();
//                print_r($arrta);
        $statementOfacNotes = $objNotes->getRow("web_app_notes_id='1'"); 
        $arrSettingsData = $objSettings->getRow("settings_id='1'");
        $paymentDueofParent = $objSmart->schoolFeesInfo($fathercode); 
 		$statementOfAccount = $objSmart->statementOfAccount($fathercode);
        $fatherDetails = $objSmart->getFatherDetailsPayment($fathercode);
		$motherDetails = $objSmart->getMotherDetailsPayment($fathercode);
		/* print_r($fatherDetails); */
		
        $newlyRegisteredStudents = $objSmart->newlyRegisteredStudents($fathercode);



//echo $fathercode; 

//$newlyRegisteredStudents = $objSmart->testSoap('00005');

//echo "test"; die();


       
        
        
		
		// print_r($statementOfAccount); 

//print_r($fatherDetails); die();

        foreach ($fatherDetails as $val) {

                $fatherEmail = $val->email1;
                $fatherEmail2 = $val->email2;
                $fatherCode = $val->fathercode;
                $fatherName = $val->title . " " . $val->firstname1 . " " . $val->secondname1 . " " . $val->thirdname1;
        }

        $fatherEmail = isset($fatherEmail) ? $fatherEmail : $fatherEmail2;
//                echo $fatherEmail.'<br>'.$fatherEmail2;

        foreach ($motherDetails as $val) {

                $motherEmail = $val->email1;
                $motherEmail2 = $val->email2;
                $motherCode = $val->mothercode;
                $motherName = $val->title . " " . $val->firstname1 . " " . $val->secondname1 . " " . $val->thirdname1;
        }

        $motherEmail = isset($motherEmail) ? $motherEmail : $motherEmail2;
//                echo $motherEmail.'<br>'.$motherEmail2;
        foreach ($statementOfAccount as $val) {

                $academicYear1 = $val->academicyear . "/" . ($val->academicyear + 1);
                $mothercode = $val->mothercode;
        }

        foreach ($newlyRegisteredStudents as $val) {

                $academicYear2 = $val->academicyear . "/" . ($val->academicyear + 1);
        }
		
		foreach ($paymentDueofParent as $val) {

                $academicYear3 = $val->academicyear . "/" . ($val->academicyear + 1);
        }
				
        /* $academicYear = isset($academicYear1) ? $academicYear1 : $academicYear2;
		 */
		 
		$academicYear = isset($academicYear3) ? $academicYear3 : $academicYear2;
				
        /* echo $academicYear.'<br>'; */
		
        $iac = @$_REQUEST['iac'];
        switch ($iac) {
                case 1:$iacMsg = 'Please Enter a valid amount';
                        break;
                case 2:$iacMsg = 'Do not enter a value greater than outstanding amount';
                        break;
                default :break;
        }
?>
<link rel="stylesheet" type="text/css" href="css/developer.css">

<div class="user_area">
        <div id="loginContainer">
                <span style="color: #a88758;text-decoration: none;"><?= $fatherName ?></span> <li><a href="changePassword.php">Change Password</a><br><br><a href="logout.php">Log Out</a></span></li>
                <!--    <ul class="user_drop">
                
                                <li><a href="changePassword.php">Change Password</a></li>
                                <li><a href="logout.php">Log Out</a></li>
                                                                                        
                            </ul>
                        <div id="loginBox">
                            <div class="up_arrow"><img src="images/drop-arrow.png"></div>
                            <ul class="user_drop">
                
                                <li><a href="changePassword.php">Change Password</a></li>
                                <li><a href="logout.php">Log Out</a></li>
                                                                                        
                            </ul>
                        </div>-->
        </div>
    <!--    <p>&nbsp;</p>-->
    <!--    <div> <span><a href="changePassword.php">Change Password</a></span> &nbsp;  <a href="javascript:void(0)">|</a>&nbsp; <span> <a href="logout.php">Log Out</a></span></div>-->
</div>