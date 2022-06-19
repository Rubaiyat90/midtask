<!DOCTYPE html>
<html>
<head>

</head>
<body>
    <table>
    <?php echo "<table border='1'>" ?>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Mobile No</th>
            <th>Address</th>
            <th>Country</th>
        </tr>
        
    
<?php

if(filesize("regData.json")>0){
    $f = fopen("regData.json","r");
$fr = fread($f,filesize("regData.json"));
$data = json_decode($fr);
fclose($f);
foreach($data as $user){
    echo "<tr>";
    echo "<td>", $user -> firstname , "</td>";
    echo "<td>", $user -> lastname , "</td>";
    echo "<td>", $user -> username , "</td>";
    echo "<td>", $user -> gender , "</td>";
    echo "<td>", $user -> email , "</td>";
    echo "<td>", $user -> mobileno , "</td>";
    echo "<td>", $user -> address , "</td>";
    echo "<td>", $user -> country , "</td>";
    echo "</tr>";
}


}
else{echo "No current users";}

?>    
    </table>
</body>
</html>
