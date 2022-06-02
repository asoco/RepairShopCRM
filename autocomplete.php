 <?php

header('Content-type: application/json');
$json = array();
$result= $mysql->query("SELECT `name_prod_list` FROM `productlist`"); 
while($row = $result->fetch_assoc()){         
	$json[]= $row;
	}                                    

?>