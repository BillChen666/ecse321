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
    echo '<pre><span class="inner-pre" style="font-size: 40px">Role: '.print_r($user_details['role'],true).'</span></pre>';
    echo '<font size="20px"><a href="logout.php">logout</a></font>';
}
?>
<div id="staff">
	<h2> Staff </h2>
	    <table style="width:100%" id="pagetable">
    	<tr>
    		<th>Staff names</th>
    		<th>Progress</th>
    	</tr>
    	
    	<?php 
    	if (isset ( $_SESSION ['staff_details'] ) && ! empty ( $_SESSION ['staff_details'] ))
    	{
    	    $staff_details=json_decode($_SESSION['staff_details'],true);
    	}
    	else {
    	    $_SESSION['errorItem']='Do not have lab';
    	    header("Location:lab.php");
    	    exit();
    	}
    	foreach ($staff_details as $staff_detail)
    	{
    	    if(!empty($staff_detail['staff_name']) && !empty($staff_detail['progress']))
    	    {
    	        ?>
    	        <tr>
    	        <?php
    	        echo '<td style="font-size: 30px">'.print_r($staff_detail['staff_name'],true).'</td>';
    	        echo '<td style="font-size: 30px">'.print_r($staff_detail['progress'],true).'</td>';
    	        ?>
    	        </tr>
    	        <?php
    	    }
    	    else{
    	        
        	    foreach ($staff_detail as $staff)
        	    {
        	        ?>
        	        <tr>
        	        <?php
        	        echo '<td style="font-size: 30px">'.print_r($staff['staff_name'],true).'</td>';
        	        echo '<td style="font-size: 30px">'.print_r($staff['progress'],true).'</td>';
        	        ?>
        	        </tr>
        	        <?php
        	    }
    	    }
    	}
        	
    	?>
    	</table>
</div>
<div id ="supply">
	<h2> Supply </h2>
	    <table style="width:100%" id="pagetable">
    	<tr>
    		<th>Supply names</th>
    		<th>Supply quantity</th>
    	</tr>
    	
    	<?php 
    	if (isset ( $_SESSION ['supply_details'] ) && ! empty ( $_SESSION ['supply_details'] ))
    	{
    	    $supply_details=json_decode($_SESSION['supply_details'],true);
    	}
    	else {
    	    $_SESSION['errorItem']='Do not have lab';
    	    header("Location:lab.php");
    	    exit();
    	}
    	foreach ($supply_details as $supply_detail)
    	{
    	    if(!empty($supply_detail['supply_name']) && !empty($supply_detail['supply_quantity']))
    	    {
    	        ?>
    	        <tr>
    	        <?php
    	        echo '<td style="font-size: 30px">'.print_r($supply_detail['supply_name'],true).'</td>';
    	        echo '<td style="font-size: 30px">'.print_r($supply_detail['supply_quantity'],true).'</td>';
    	        ?>
    	        </tr>
    	        <?php
    	    }
    	    else{
    	        
        	    foreach ($supply_detail as $supply)
        	    {
        	        ?>
        	        <tr>
        	        <?php
        	        echo '<td style="font-size: 30px">'.print_r($supply['supply_name'],true).'</td>';
        	        echo '<td style="font-size: 30px">'.print_r($supply['supply_quantity'],true).'</td>';
        	        ?>
        	        </tr>
        	        <?php
        	    }
    	    }
    	}
        	
    	?>
    	</table>
</div>
<div id="equipment">
	<h2> Equipment </h2>
	    <table style="width:100%" id="pagetable">
    	<tr>
    		<th>Equipment names</th>
    		<th>Quantity</th>
    	</tr>
    	
    	<?php 
    	if (isset ( $_SESSION ['equipment_details'] ) && ! empty ( $_SESSION ['equipment_details'] ))
    	{
    	    $equipment_details=json_decode($_SESSION['equipment_details'],true);
    	}
    	else {
    	    $_SESSION['errorItem']='Do not have lab';
    	    header("Location:lab.php");
    	    exit();
    	}
    	foreach ($equipment_details as $equipment_detail)
    	{
    	    if(!empty($equipment_detail['equipment_name']) && !empty($equipment_detail['equipment_quantity']))
    	    {
    	        ?>
    	        <tr>
    	        <?php
    	        echo '<td style="font-size: 30px">'.print_r($equipment_detail['equipment_name'],true).'</td>';
    	        echo '<td style="font-size: 30px">'.print_r($equipment_detail['equipment_quantity'],true).'</td>';
    	        ?>
    	        </tr>
    	        <?php
    	    }
    	    else{
    	        foreach ($equipment_detail as $equipment)
    	        {
        	        ?>
        	        <tr>
        	        <?php
        	        echo '<td style="font-size: 30px">'.print_r($equipment['equipment_name'],true).'</td>';
        	        echo '<td style="font-size: 30px">'.print_r($equipment['equipment_quantity'],true).'</td>';
        	        ?>
        	        </tr>
        	        <?php
    	        }
    	    }    
    	    
    	}
        	
    	?>
    	</table>
</div>

<div id="picture">
<img src="../imgsrc/321-3.png"  style="width:480px;height:270px;"></img>
</div>
</body>
</html>
