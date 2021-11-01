<?php require_once('Connections/connpatient.php'); ?>
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
  $insertSQL = sprintf("INSERT INTO payment (paymentID, paymenttype, treatmentID, anount, dateofpayment, programeID) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['paymentID'], "int"),
                       GetSQLValueString($_POST['paymenttype'], "text"),
                       GetSQLValueString($_POST['treatmentID'], "int"),
                       GetSQLValueString($_POST['anount'], "text"),
                       GetSQLValueString($_POST['dateofpayment'], "date"),
                       GetSQLValueString($_POST['programeID'], "int"));

  mysql_select_db($database_connpatient, $connpatient);
  $Result1 = mysql_query($insertSQL, $connpatient) or die(mysql_error());
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dashboard</title>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
</head>

<body bgcolor="#f1f1f1">

<table width="100%">
  <tr>
    <td height="110" bgcolor="#3cb371">
      <table width="100%">
        <tr>
          <td width="26%"><img src="images/logo.png" width="100" height="100" alt="Hospital Logo" style=" margin-left:20px"/></td>
          <td width="74%" style="color:#ffffff ; margin-left:20px"><h3>MEDI CARE HOSPITAL</h3></td>
        </tr>
     </table></td>
  </tr>
  <tr>
    <td><ul id="MenuBar1" class="MenuBarHorizontal">
 <li><a href="#" class="MenuBarItemSubmenu" style="background-color: #3cb371;">Finance</a>
        <ul>
          <li><a href="#">Add Payment</a></li>
          <li><a href="viewpayment.php">Check Payment</a></li>
        </ul>
      </li>
      <li><a href="dashboard.php">Home</a></li>
      <li><a href="#" class="MenuBarItemSubmenu" >Hospital</a>
  <ul>
          <li><a href="addhospital.php">Hospital Detaisl</a></li>
          <li><a href="addstaff.php">Add Staff</a></li>
          <li><a href="adddepartment.php">Departments</a></li>
        </ul>
    </li>
      <li><a class="MenuBarItemSubmenu" href="#">Patient</a>
        <ul>
          <li><a href="addpatient.php">Add Patient</a>            </li>
          <li><a href="addtreatment.php">Treatment</a></li>
</ul>
    </li>
     
      <li><a href="#">Logout</a></li>
    </ul>
    <br />
   
    </td>
     <tr> <td><hr color="#3cb371" size="5" /></td> </tr>
  </tr>
  
  <tr>
    <td width="50%" style="height:70vh">
      <fieldset>
    
    <legend align="center" >Enter Hospital Details</legend>
   <center>
     <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
       <table align="center">
         <tr valign="baseline">
           <td nowrap="nowrap" align="right">PaymentID:</td>
           <td><input type="text" name="paymentID" value="" size="32" /></td>
         </tr>
         <tr valign="baseline">
           <td nowrap="nowrap" align="right">Paymenttype:</td>
           <td><select name="paymenttype">
            <option>CASH ONLY</option>
            <option>NHIF </option>
           </select></td>
         </tr>
         <tr valign="baseline">
           <td nowrap="nowrap" align="right">TreatmentID:</td>
           <td><input type="text" name="treatmentID" value="" size="32" /></td>
         </tr>
         <tr valign="baseline">
           <td nowrap="nowrap" align="right">Anount:</td>
           <td><input type="text" name="anount" value="" size="32" /></td>
         </tr>
         <tr valign="baseline">
           <td nowrap="nowrap" align="right">Date of Payment:</td>
           <td><input type="date" name="dateofpayment" value="" size="32" /></td>
         </tr>
         <tr valign="baseline">
           <td nowrap="nowrap" align="right">ProgrameID:</td>
           <td><input type="text" name="programeID" value="" size="32" /></td>
         </tr>
         <tr valign="baseline">
           <td nowrap="nowrap" align="right">&nbsp;</td>
           <td><input type="submit" value="Save Payment" />
             <input type="reset" name="Reset" id="button" value="Reset Form" /></td>
         </tr>
       </table>
       <input type="hidden" name="MM_insert" value="form1" />
     </form>
     <p>&nbsp;</p>
   </center>
   
  
    </fieldset>
    <br />
     <fieldset>
    
    <legend align="center" >Availbale Payment </legend>
   
  
    </fieldset>
  
    </td>
  </tr>
  <tr>
    <td height="100" bgcolor="#3cb371"><center><p style="color:#ffffff">&copy; COPYRIGHT 2021 MEDI CARE HOSPITAL. ALL RIGHTS RESERVED</p></center></td>
  </tr>
</table>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
</html>