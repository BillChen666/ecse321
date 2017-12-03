<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style type="text/css">
#loginpanel {
position:absolute;
left:800px;
top:200px;
}
#picture {
position:absolute;
left:50px;
top:600px;
}
#staff{
position:absolute;
left:700px;
top:50px;
font-size:40px;
}
#equipment{
position:absolute;
left:1400px;
top:50px;
font-size:40px;
}
#supply{
position:absolute;
left:700px;
top:700px;
font-size:40px;
}
#expense{
position:absolute;
left:1400px;
top:700px;
font-size:40px;
}
.error {
	color: #FF0000;
}
</style>
</head>
<body background="../imgsrc/321-2.png">
<?php
require_once __DIR__.'/../controller/InputValidator.php';
require_once __DIR__.'/../model/Equipment.php';
require_once __DIR__.'/../model/Expense.php';
require_once __DIR__.'/../model/Lab.php';
require_once __DIR__.'/../model/Staff.php';
require_once __DIR__.'/../model/Supply.php';
require_once __DIR__.'/../model/URLMS.php';
require_once __DIR__.'/../persistence/PersistenceLabManagement.php';
session_start();
if (isset ( $_SESSION ['login'] ) && ! empty ( $_SESSION ['login'] )) 
{
    $user_details=json_decode($_SESSION['user_details'],true);
    echo '<pre><span class="inner-pre" style="font-size: 40px">Username: '.print_r($user_details['username'],true).'</span></pre>';
    echo '<pre><span class="inner-pre" style="font-size: 40px">Budget: '.print_r($user_details['budget'],true).'</span></pre>';
    echo '<font size="20px"><a href="logout.php">logout</a></font>';
}
?>
<div id="staff">
	<h2> Add Staff </h2>
	<form action = "addstaff.php" method="post">
		<br>
		<p>Staff Name: <input type="text" name="staff_name" placeholder="Enter Name"/>
		<p>Progress: <input type="text" name="progress" placeholder="Enter progress"/>
		</p>
		Role: <select name="staff_role">
		<option>Researcher</option>
		<option>Assistant</option>
		</select>
		<span class="error">
		<?php
		if (isset ( $_SESSION ['errorStaff'] ) && ! empty ( $_SESSION ['errorStaff'] )) {
		    echo " * " . $_SESSION ['errorStaff'];
        }
        ?>
		</span>
		<p><input type="submit" value="Add Staff" style="height:100px;width:200px">
		<button type="button" onclick="window.location.href='staff.php'" style="height:100px;width:200px;">View</button></p>
		<br>
	</form>
</div>
<div id ="supply">
	<h2>Add Supply</h2>
	<form action="addsupply.php" method="post">
		<br>
		<p>Supply name: <input type="text" name="supply_name" placeholder="Enter Name"/>
		<p>Supply quantity: <input type="text" name="supply_quantity" placeholder="Enter Quantity"/>
		</p>
		<span class="error">
		<?php
		if (isset ( $_SESSION ['errorSupply'] ) && ! empty ( $_SESSION ['errorSupply'] )) {
		    echo " * " . $_SESSION ['errorSupply'];
        }
        ?>
		</span>
		<p><input type ="submit" value="Add supply" style="height:100px;width:200px"/>
		<button type="button" onclick="window.location.href='supply.php'" style="height:100px;width:200px;">View</button></p>
		<br>
    </form>
</div>
<div id="equipment">
	<h2>Add Equipment</h2>
	<form action="addequipment.php" method="post">
		<br>
		<p>Equipment name: <input type="text" name="equipment_name" placeholder="Enter Name"/>
		<p>Quantity: <input type="text" name="quantity" placeholder="Enter Quantity"/>
		</p>
		<span class="error">
		<?php
		if (isset ( $_SESSION ['errorEquipment'] ) && ! empty ( $_SESSION ['errorEquipment'] )) {
		    echo " * " . $_SESSION ['errorEquipment'];
        }
        ?>
		</span>
		<p><input type ="submit" value="Add equipment" style="height:100px;width:200px"/>
		<button type="button" onclick="window.location.href='equipment.php'" style="height:100px;width:200px;">View</button></p>
		<br>
    </form>
</div>
<div id="expense">
	<h2>Add Expense</h2>
	<form action="addexpense.php" method="post">
		<br>
		<p>Reason: <input type="text" name="reason" placeholder="Enter Reason"/>
		<p>Amountpaid: <input type="text" name="amount" placeholder="Enter Amount"/>
		</p>
		<span class="error">
		<?php
		if (isset ( $_SESSION ['errorExpense'] ) && ! empty ( $_SESSION ['errorExpense'] )) {
		    echo " * " . $_SESSION ['errorExpense'];
        }
        ?>
		</span>
		<p><input type ="submit" value="Add expense" style="height:100px;width:200px"/>
		<button type="button" onclick="window.location.href='expense.php'" style="height:100px;width:200px;">View</button></p>
		<br>
    </form>
</div>
<div id="picture">
<img src="../imgsrc/321-3.png"  style="width:480px;height:270px;"></img>
</div>
</body>
</html>
<?php 
unset($_SESSION['errorStaff']);
unset($_SESSION['errorSupply']);
unset($_SESSION['errorEquipment']);
unset($_SESSION['errorExpense']);
?>