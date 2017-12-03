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
    </style>
</head>
<body background="../imgsrc/321-2.png">
    <div id="pagetitle">
    <t1>Remove Staff</t1>
    </div>

	<div id="pageinfo">
    	<form action="remove.php" method="post">
    	<select style="height:50px;width:300px" name="staff_remove">
    	<?php 
    	session_start();
    	if (isset ( $_SESSION ['staff_details'] ) && ! empty ( $_SESSION ['staff_details'] ))
    	{
    	    $staff_details=json_decode($_SESSION['staff_details'],true);
    	}
    	else {
    	    $_SESSION['errorItem']='Do not have staff';
    	    header("Location:staff.php");
    	    exit();
    	}
    	foreach ($staff_details as $staff_detail)
    	{
    	    if(!empty($staff_detail['staff_name']) && !empty($staff_detail['progress']))
    	    {
    	        echo '<option style="font-size: 30px">'.print_r($staff_detail['staff_name'],true).'</option>';
    	    }
    	    else{
    	        
        	    foreach ($staff_detail as $staff)
        	    {
        	        echo '<option style="font-size: 30px">'.print_r($staff['staff_name'],true).'</option>';
        	    }
    	    }
    	}
        	
    	?>
    	</select>
    	<input type="submit" value="remove"  style="height:50px;width:100px"/>
    	</form>
    </div>
    
    <div id="pagebutton">
		<button type="button" onclick="window.location.href='lab.php'" style="height:100px;width:200px;">Back</button>
    </div>
    
    <div id="picture">
    	<img src="../imgsrc/321-3.png"  style="width:480px;height:270px;"></img>
    </div>
</body>
</html>