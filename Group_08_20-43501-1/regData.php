<?php


if ($_SERVER['REQUEST_METHOD'] === "POST") {

    function test_input($data) {
        $data = htmlspecialchars($data);
        return $data;
    }

    $firstname = test_input($_POST['firstname']);
    $lastname = test_input($_POST['lastname']);
    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);
    $gender = isset($_POST['gender']) ? test_input($_POST['gender']) : "";
    $email = test_input($_POST['email']);
    $mobileno = test_input($_POST['mobileno']);
    $address1 = test_input($_POST['address1']);
    $country = isset($_POST['country']) ? test_input($_POST['country']) : "";
    
    $messege = '';
    if (empty($firstname)) {
        $messege .= "First Name is Empty\n";
    }
    else {
        if (!preg_match("/^[a-zA-Z-' ]*$/",$firstname)) {
        $messege .= "Only letters and spaces allowed.\n";
        }
    }
    if (empty($lastname)) {
        $messege .= "Last Name is Empty\n";				
    }
    else {
        if (!preg_match("/^[a-zA-Z-' ]*$/",$lastname)) {
        $messege .= "Only letters and spaces allowed.\n";
        }
    }
    if(empty($username)){
        $messege .= "Username is empty\n";
    }
    if (empty($password)) {
        $messege .= "Password is empty\n";
    }
    elseif ($password!=$_POST['cpassword']) {
        $messege .= "Password and confirm password does not match\n";
    }
    if (empty($gender)) {
        $messege .= "Gender not selected\n";
    }
    if (empty($email)) {
        $messege .= "Email is empty\n";
    }
    else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $messege .= "Email is incorrect\n";
        }
    }
    if (empty($mobileno)) {
        $messege .= "Mobile No is empty\n";
    }
    elseif(!preg_match('/^\d+$/',$mobileno))
    {
        $messege .= "Mobile No must only contain numbers\n";
    }
    elseif (strlen($mobileno)!=11) {
        $messege .= "Mobile No must have 11 digits\n";
    }
    if (empty($address1)) {
        $messege .= "Street/House/Road is empty\n";
    }			
    if (!isset($country) or empty($country)) {
        $messege .= "Country is empty\n";
    }
    if(empty($messege)){
        $arr = array('firstname' => $firstname, 'lastname' =>$lastname,
        'username' => $username, 'password' => $password, 
        'gender' => $gender, 'email' => $email, 'mobileno' => $mobileno,
        'address' => $address1, 'country' => $country);
        if(filesize("regData.json")==0){            
        $data = json_encode(array($arr));
        $f = fopen("regData.json","a");
        fwrite($f,$data . "\n");
        fclose($f);
        }
        else{
            $f = fopen("regData.json","r");
            $data = json_decode(fread($f,filesize("regData.json"))); 
            $data[] = $arr;
            fclose($f);
            $f = fopen("regData.json","w");
            fwrite($f,json_encode($data));
            fclose($f);

            
        }
        
        echo "Reg successfull";        
    }
    else{
        echo $messege;
    }
    
}
?>
