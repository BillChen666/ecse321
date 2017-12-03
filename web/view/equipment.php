<?php
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <style type="text/css">
    #pagetitle {
        position:absolute;
        left:800px;
        top:100px;
        font-size:100px;
    }
    #picture {
        position:absolute;
        left:50px;
        top:600px;
    }
    #pageinfo{
        position:absolute;
        left:800px;
        top:400px;
        font-size:40px;
    }
    #pagebutton{
        position:absolute;
        left:1800px;
        top:1000px;
        font-size:60px;
    }
    #pagetable{
        padding: 10px 0;
    }
    </style>
</head>
<body background="../imgsrc/321-2.png">
    <div id="pagetitle">
    <t1>Equipment</t1>
    </div>

	<div id="pageinfo">
    	<table style="width:100%" id="pagetable">
    	<tr>
    		<th>Equipment names</th>
    		<th>Quantity</th>
    	</tr>
    	
    	<?php 
    	session_start();
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
    
    <div id="pagebutton">
		<button type="button" onclick="window.location.href='lab.php'" style="height:100px;width:200px;">Back</button>
    	<button type="button" onclick="window.location.href='removeEquipment.php'" style="height:100px;width:200px;">Remove</button>
    </div>
    
    <div id="picture">
    	<img src="../imgsrc/321-3.png"  style="width:480px;height:270px;"></img>
    </div>
</body>
</html>