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
    <t1>expense</t1>
    </div>

	<div id="pageinfo">
    	<table style="width:100%" id="pagetable">
    	<tr>
    		<th>Expense reasons</th>
    		<th>Amount</th>
    	</tr>
    	
    	<?php 
    	session_start();
    	if (isset ( $_SESSION ['expense_details'] ) && ! empty ( $_SESSION ['expense_details'] ))
    	{
    	    $expense_details=json_decode($_SESSION['expense_details'],true);
    	}
    	else {
    	    $_SESSION['errorItem']='Do not have lab';
    	    header("Location:lab.php");
    	    exit();
    	}
    	foreach ($expense_details as $expense_detail)
    	{
    	    if(!empty($expense_detail['reason']) && !empty($expense_detail['amount']))
    	    {
    	        ?>
    	        <tr>
    	        <?php
    	        echo '<td style="font-size: 30px">'.print_r($expense_detail['reason'],true).'</td>';
    	        echo '<td style="font-size: 30px">'.print_r($expense_detail['amount'],true).'</td>';
    	        ?>
    	        </tr>
    	        <?php
    	    }
    	    else {
    	        foreach ($expense_detail as $expense)
        	    {
        	        ?>
        	        <tr>
        	        <?php
        	        echo '<td style="font-size: 30px">'.print_r($expense['reason'],true).'</td>';
        	        echo '<td style="font-size: 30px">'.print_r($expense['amount'],true).'</td>';
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
    </div>
    
    <div id="picture">
    	<img src="../imgsrc/321-3.png"  style="width:480px;height:270px;"></img>
    </div>
</body>
</html>