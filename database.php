<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "service_center");

$mysql = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
if (!isset($_POST["action"]))
	 $_POST["action"] = Null;
if (!isset($_POST["warranty"]))
	 $_POST["warranty"] = Null;
if (mysqli_connect_errno()) {
    printf("Соединение не удалось: %s\n", mysqli_connect_error());
    exit();
}

if ($_POST["action"])
{
    switch ($_POST["action"])
    {
        case 'register':
            register();
        break;
        case 'newtask':
            new_task();
        break;
        case 'neworder':
            new_order();
        break;
        case 'managetask':
            manage_task();
        break;
        case 'orderdelivered':
            order_delivered();
        break;
        case 'getprovider':
            get_provider();
        break;
        case 'setmaster':
            set_master();
        break;
        case 'doneorder':
            done_order();
        break;
         case 'closeorder':
            close_order();
        break;
        case 'delivered':
            take_delivery();
        break;
        case 'takethis':
            take_this();
        break;
        case 'get_empl_rep':
            get_empl_rep();
        break;
        default:
            header($_SERVER['SERVER_PROTOCOL'] . "404 Not Found");
    }
}

function register()
{
    global $mysql;
    $login = filter_var(trim($_POST['login']) , FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['pass']) , FILTER_SANITIZE_STRING);
    $name = filter_var(trim($_POST['name']) , FILTER_SANITIZE_STRING);
    $role = filter_var(trim($_POST['role']) , FILTER_SANITIZE_STRING);

    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $adduser = Null;
    $checkexist = $mysql->query("SELECT * FROM `users` WHERE `login`='$login'");
    $checkexist = $checkexist->fetch_assoc();
    if (count($checkexist) == 0)
    {
        $adduser = $mysql->query("INSERT INTO  `users` (`login`,`pass`,`name`,`role`) VALUES('$login','$pass','$name','$role')");
        $success = True;
    }
    else
    {
        $success = False;
    }
    Header('Location: register.php?success=' . $success);
}
function new_task()
{
    global $mysql;
    // client information
    $name_client = filter_var(trim($_POST['Name_client']) , FILTER_SANITIZE_STRING);
    $phone_client = filter_var(trim($_POST['Phone_client']) , FILTER_SANITIZE_STRING);
    $referrer = filter_var(trim($_POST['referrer']) , FILTER_SANITIZE_STRING);
    // device info
    $hw_name = filter_var(trim($_POST['hw_name']) , FILTER_SANITIZE_STRING);
    $sn_hw = filter_var(trim($_POST['sn_hw']) , FILTER_SANITIZE_STRING);
	$warranty = 0;
    if (filter_var(trim($_POST['warranty']) , FILTER_SANITIZE_STRING))
    	$warranty = 1;
    $hw_name = filter_var(trim($_POST['hw_name']) , FILTER_SANITIZE_STRING);
    $problems = filter_var(trim($_POST['problems']) , FILTER_SANITIZE_STRING);
    $device_condition = filter_var(trim($_POST['device_condition']) , FILTER_SANITIZE_STRING);
    // $addorder = Null;
    $ID_client = Null;
    $mstr = filter_var(trim($_POST['mstr']) , FILTER_SANITIZE_STRING);
	$addclient = $mysql->query("INSERT INTO  `clients` (`ID_client`,`Name_client`,`phone_client`,`referrer`) VALUES(Null,'$name_client','$phone_client','$referrer')");
        $last_id = mysqli_insert_id($mysql);
    $mysql->query("INSERT INTO `client_orders` (`ID_order`, `sn_hw_order`, `name_hw_order`, `order_datetime`, `order_end_datetime`, `warranty_order`, `exec_order_start`, `exec_order_end`, `out_order`, `ID_client`, `price_order`, `device_condition`,`problems` ) VALUES (NULL, '$sn_hw', '$hw_name', NOW(), 'NULL', '$warranty', 'NULL', 'NULL', 'NULL',$last_id, '1500', '$device_condition','$problems') ");
    $addorder = $mysql->query("INSERT INTO `order_empls` (`ID_order`, `ID_empl`) VALUES ((SELECT `ID_order` FROM `client_orders` WHERE `name_hw_order`='$hw_name' AND `sn_hw_order`='$sn_hw'), '$mstr') ");
     
    Header('Location: index.php?page=newtask');
}
function new_order()
{
    global $mysql;
    // client information
    $ID_cat_part = Null;
    $Name_part = filter_var(trim($_POST['Name_part']) , FILTER_SANITIZE_STRING);
    $Provider_part_name = filter_var(trim($_POST['Provider_part']) , FILTER_SANITIZE_STRING);
    $Price_part = filter_var(trim($_POST['Price_part']) , FILTER_SANITIZE_STRING);
    $Color_part = filter_var(trim($_POST['Color_part']) , FILTER_SANITIZE_STRING);
    $Vendor_part = filter_var(trim($_POST['Vendor_part']) , FILTER_SANITIZE_STRING);
    $Quantity_part = filter_var(trim($_POST['Quantity_part']) , FILTER_SANITIZE_STRING);
    $Condition_part = filter_var(trim($_POST['Condition_part']) , FILTER_SANITIZE_STRING);
    $Status_delivery = 'Ожидает доставки';
    // получаем номер поставщика
    $checkprov = $mysql->query("SELECT `ID_provider` FROM `providers` WHERE `Name_provider`='$Provider_part_name' ");
    $provid = $checkprov->fetch_assoc(); 
    $provid = $provid['ID_provider'];
    // чек если запчасть уже есть на складе
    $checkpart = $mysql->query("SELECT * FROM `catalog_parts` WHERE `Name_part`='$Name_part' AND `ID_provider`='$provid' AND `Condition_part`='$Condition_part' AND `Color_part`='$Color_part' AND `Vendor_part`='$Vendor_part'");
    $checkpart = $checkpart->fetch_assoc();
    if (count($checkpart) > 0) {
            $ID_cat_part = $checkpart['ID_cat_part'];
            $Quantity_part = $checkpart['Quantity_part']+$Quantity_part;
            $mysql->query("UPDATE `catalog_parts` SET `ID_cat_part`='$ID_cat_part',`Name_part`='$Name_part',`Price_part`='$Price_part',`Color_part`='$Color_part',`Vendor_part`='$Vendor_part',`Condition_part`='$Condition_part',`Quantity_part`='$Quantity_part',`Status_delivery`='$Status_delivery',`ID_provider`='$provid' WHERE `ID_cat_part`='$ID_cat_part'");

    }

    $mysql->query("INSERT INTO `catalog_parts` (`ID_cat_part`, `Name_part`, `Price_part`, `Color_part`, `Vendor_part`, `Condition_part`, `Quantity_part`, `Status_delivery`, `ID_provider`) VALUES ('$ID_cat_part', '$Name_part', '$Price_part', '$Color_part', '$Vendor_part', '$Condition_part', '$Quantity_part', '$Status_delivery', '$provid')");
        if ($mysql){
             Header('Location: index.php?page=neworder&success=true');
         }else{
             Header('Location: index.php?page=neworder&success=false');
        }
}
function order_delivered()
{
    global $mysql;
    $ID_cat_part = filter_var(trim($_POST['ID_cat_part']) , FILTER_SANITIZE_STRING);
    $Name_part = filter_var(trim($_POST['Name_part']) , FILTER_SANITIZE_STRING);
    $Provider_part_name = filter_var(trim($_POST['Provider_part']) , FILTER_SANITIZE_STRING);
    $Price_part = filter_var(trim($_POST['Price_part']) , FILTER_SANITIZE_STRING);
    $Color_part = filter_var(trim($_POST['Color_part']) , FILTER_SANITIZE_STRING);
    $Vendor_part = filter_var(trim($_POST['Vendor_part']) , FILTER_SANITIZE_STRING);
    $Quantity_part = filter_var(trim($_POST['Quantity_part']) , FILTER_SANITIZE_STRING);
    $Condition_part = filter_var(trim($_POST['Condition_part']) , FILTER_SANITIZE_STRING);

    $checkprov = $mysql->query("SELECT `ID_provider` FROM `providers` WHERE `Name_provider`='$Provider_part_name' ");
    $provid = $checkprov->fetch_assoc(); 
    $provid = $provid['ID_provider'];

    $checkpart = $mysql->query("SELECT * FROM `catalog_parts` WHERE `Name_part`='$Name_part' AND `Provider_part`='$provid' AND `Condition_part`='$Condition_part' AND `Color_part`='$Color_part' AND `ID_provider`='$Vendor_part'");
    $checkpart = $checkpart->fetch_assoc();
    $Status_delivery = 'Доставлено';
    if (count($checkpart) > 0) {
            $ID_cat_part = $checkpart['ID_cat_part'];
            $Quantity_part = $checkpart['Quantity_part']+$Quantity_part;
            $mysql->query("UPDATE `catalog_parts` SET `Status_delivery`='$Status_delivery' WHERE `ID_cat_part`='$ID_cat_part'");
    } else {
        Header('Location: index.php?page=takeorder&success=false');
    }
        if ($mysql){
             Header('Location: index.php?page=takeorder&success=true');
         }else{
             Header('Location: index.php?page=takeorder&success=false');
        }
}

function manage_task(){
    global $mysql;
    $client_list = $mysql->query("SELECT * FROM `clients` WHERE `Name_client`='$name_client' AND `Phone_client`='$phone_client'");
    $client_list = $client_list->fetch_assoc();
}

function get_provider(){
    global $mysql;
    $Name = $_POST['name'];
    $result = $mysql->query("SELECT * FROM `providers` WHERE `Name_provider`='$Name' ");
    $_POST['provider-info'] = $result->fetch_assoc();
    print_r($_POST['provider-info']);
}


function set_master() {
    global $mysql;
    $ID_order = filter_var(trim($_POST['ID_order']) ,FILTER_SANITIZE_STRING);
    $ID_empl = '1';
    $checkorder = ($mysql->query("SELECT * FROM `order_empls` WHERE `ID_order`=$ID_order ")->fetch_assoc());
    if (!empty($checkorder)){
        exit('Заказ занят');
    }
    $mysql->query("INSERT INTO `order_empls` (`ID_order`, `ID_empl`) VALUES ('$ID_order', '$ID_empl') ");
    $mysql->query("UPDATE `client_orders` SET `exec_order_start`=NOW() WHERE `ID_order`='$ID_order'");
}

function done_order() {
    global $mysql;
    $ID_order = filter_var(trim($_POST['ID_order']) ,FILTER_SANITIZE_STRING);
    $ID_empl = '1';
    $checkorder = ($mysql->query("SELECT * FROM `order_empls` WHERE `ID_order`=$ID_order ")->fetch_assoc());
    if (empty($checkorder)){
        exit('Заказ никто не брал');
    }
     $mysql->query("UPDATE `client_orders` SET `exec_order_end`=NOW() WHERE `ID_order`='$ID_order'");
}
function close_order() {
    global $mysql;
    $ID_order = filter_var(trim($_POST['ID_order']) ,FILTER_SANITIZE_STRING);
    $ID_empl = '1';
    $checkorder = ($mysql->query("SELECT * FROM `order_empls` WHERE `ID_order`=$ID_order ")->fetch_assoc());
    // print_r($checkorder);
    if (empty($checkorder)){
        exit('Заказ никто не брал');
    }
     $mysql->query("UPDATE `client_orders` SET `order_end_datetime`=NOW() WHERE `ID_order`='$ID_order'");
}

function take_delivery()
{
    global $mysql;
    $ID_cat_part = filter_var(trim($_POST['ID_cat_part']) ,FILTER_SANITIZE_STRING);
    $check_catalog = ($mysql->query("SELECT * FROM `catalog_parts` WHERE `ID_cat_part`= '$ID_cat_part' ")->fetch_assoc());
    if (empty($check_catalog)){
        exit('Такого товара не существует');
    }
     $mysql->query("UPDATE `catalog_parts` SET `Status_delivery`='Доставлено' WHERE `ID_cat_part`='$ID_cat_part'");
}
function take_this()
{
    global $mysql;
    $ID_cat_part = filter_var(trim($_POST['ID_cat_part']) ,FILTER_SANITIZE_STRING);
    $check_catalog = ($mysql->query("SELECT * FROM `catalog_parts` WHERE `ID_cat_part`= '$ID_cat_part' ")->fetch_assoc());
    if (empty($check_catalog)){
        exit('Такого товара не существует');
    }
    $tmpcount = $check_catalog['Quantity_part']-1;
    if(!empty($check_catalog) and ($check_catalog['Quantity_part'])<=0){
        exit('Товар закончился на складе');
    } 
     $mysql->query("UPDATE `catalog_parts` SET `Quantity_part`='$tmpcount' WHERE `ID_cat_part`='$ID_cat_part'");
    return '';
}
function get_empl_rep()
{
    global $mysql;
    $ID_cat_part = filter_var(trim($_POST['ID_cat_part']) ,FILTER_SANITIZE_STRING);
    print_r(($mysql->query("SELECT * FROM `order_empls` JOIN `employees` `jobs` USING(`ID_empl`)"))->fetch_assoc());

}
?>
