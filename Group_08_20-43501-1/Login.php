<!DOCTYPE html>
<html>
    <head>
        <title>Login page</title>
    </head>
    <?php 
        $username="";
        $password="";
        $u_msg="";
        $p_msg="";
        $data="";
        if ($_SERVER['REQUEST_METHOD'] === "POST") {

			function test_input($data) {
				$data = htmlspecialchars($data);
				return $data;
			}
            if(filesize("regData.json")>0){
                $f = fopen("regData.json","r");
            $fr = fread($f,filesize("regData.json"));
            $data = json_decode($fr);
            fclose($f);
            }            

            $username = test_input($_POST['username']);
            $password = test_input($_POST['password']);

            if(empty($username)){
                $u_msg .= "Username is empty ";
            }
            else{
                foreach($data as $user){
                    if($user -> username==$username){
                        $u_msg="OK";
                    }
                }
            }
            if(empty($password)){
                $p_msg .= "Password is empty";
            }
            else{
                foreach($data as $user){
                    if($user -> password==$password){
                        $p_msg="OK";
                    }
                }
            }

            if ($u_msg == "OK" && $p_msg=="OK" && $data!="") {
				echo "Login Successful";
                
			}
        }
    ?>
    <body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" novalidate>
        <fieldset>
            <legend>Login Credential</legend>
            <label for="uname">Username</label>
            <input type="text" name="username" id="uname">
            <span><?php echo $u_msg; ?></span>
            <br><br>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <span><?php echo $p_msg; ?></span>
        </fieldset>
        <input type="submit" name="submit" value="Login">
    </form>
    </body>
</html>