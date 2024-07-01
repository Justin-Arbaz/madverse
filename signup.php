<?php require_once('Connections/database.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tblusers (FirstName, LastName, Email, MobileNumber, Address, password) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['FirstName'], "text"),
                       GetSQLValueString($_POST['LastName'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['MobileNumber'], "bigint"),
                       GetSQLValueString($_POST['Address'], "text"),
                       GetSQLValueString($_POST['password'], "text"));

  mysql_select_db($database_database, $database);
  $Result1 = mysql_query($insertSQL, $database) or die(mysql_error());

  $insertGoTo = "signin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="css/signup.css" type="text/css">
</head>
<body>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
<div class="signup-table">
  <table align="center" >
  <tr class="login-item">
    <td class="text-secondary">Create account</td>
    </tr>
    <tr valign="baseline">
      <!-- <td nowrap="nowrap" align="right" class="fs-5 pe-2">FirstName:</td> -->
      <td><input type="text" name="FirstName" value="" size="32" class="form-control" placeholder="FirstName"/></td>
    </tr>
    <tr valign="baseline">
      <!-- <td nowrap="nowrap" align="right" class="fs-5 pe-2">LastName:</td> -->
      <td><input type="text" name="LastName" value="" size="32" class="form-control" placeholder="LastName"/></td>
    </tr>
    <tr valign="baseline">
      <!-- <td nowrap="nowrap" align="right" class="fs-5 pe-2">Email:</td> -->
      <td><input type="text" name="Email" value="" size="32" class="form-control" placeholder="Email"/></td>
    </tr>
    <tr valign="baseline">
      <!-- <td nowrap="nowrap" align="right" class="fs-5 pe-2">MobileNumber:</td> -->
      <td><input type="text" name="MobileNumber" value="" size="32" class="form-control" placeholder="MobileNumber"/></td>
    </tr>
    <tr valign="baseline">
      <!-- <td nowrap="nowrap" align="right" class="fs-5 pe-2">Address:</td> -->
      <td><input type="text" name="Address" value="" size="32" class="form-control" placeholder="Address"/></td>
    </tr>
    <tr valign="baseline">
      <!-- <td nowrap="nowrap" align="right" class="fs-5 pe-2">password:</td> -->
      <td><input type="password" name="password" value="" size="32" class="form-control" placeholder="Password"/></td>
    </tr>
    <tr valign="baseline" >
      <!-- <td nowrap="nowrap" align="right">&nbsp;</td> -->
      <td><input type="submit" value="sign up" class="signup-button btn btn-success mt-1" size="40" /></td>
    </tr>
    <tr>
    <td class="text-white pt-2">I have an account <a href="./signin.php" class=" text-decoration-none text-white mt-1 ">Login!</a></td>
    </tr>

  </table>
  <input type="hidden" name="MM_insert" value="form1" />
  </div>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>


