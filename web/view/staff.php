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
    <t1>Staff</t1>
    </div>

	<div id="pageinfo">
    	<table style="width:100%" id="pagetable">
    	<tr>
    		<th>Staff names  </th>
    		<th>Role  </th>
    		<th>Progress</th>		
    	</tr>
    	
    	<?php 
    	session_start();
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
    	        echo '<td style="font-size: 30px">'.print_r($staff_detail['staff_role'],true).'</td>';
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
        	        echo '<td style="font-size: 30px">'.print_r($staff['staff_role'],true).'</td>';
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
    
    <div id="pagebutton">
		<button type="button" onclick="window.location.href='lab.php'" style="height:100px;width:200px;">Back</button>
		<button type="button" onclick="window.location.href='removestaff.php'" style="height:100px;width:200px;">Remove</button>
    </div>
    
    <div id="picture">
    	<img src="../imgsrc/321-3.png"  style="width:480px;height:270px;"></img>
    </div>
</body>
</html>