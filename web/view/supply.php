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
    <t1>Supply</t1>
    </div>

	<div id="pageinfo">
    	<table style="width:100%" id="pagetable">
    	<tr>
    		<th>Supply names</th>
    		<th>Supply quantity</th>
    	</tr>
    	
    	<?php 
    	session_start();
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
    
    <div id="pagebutton">
		<button type="button" onclick="window.location.href='lab.php'" style="height:100px;width:200px;">Back</button>
    	<button type="button" onclick="window.location.href='removesupply.php'" style="height:100px;width:200px;">Remove</button>
    </div>
    
    <div id="picture">
    	<img src="../imgsrc/321-3.png"  style="width:480px;height:270px;"></img>
    </div>
</body>
</html>