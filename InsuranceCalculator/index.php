<?php
/*
 * 
 * Copyright 2018 keshav <keshav@keshav-Vostro-3546>
 
	1. Create HTML form with fields:
		• Estimated value of the car (100 - 100 000 EUR)
		• Tax percentage (0 - 100%)
		• Number of instalments (count of payments in which client wants to pay for the policy (1 – 12))
		• Calculate button
		
	2. Build calculator logic in PHP using OOP:
		• Base price of policy is 11% from entered car value, except every Friday 15-20 o’clock (user time) when it is 13%
		• Commission is added to base price (17%)
		• Tax is added to base price (user entered)
		• Calculate different payments separately (if number of payments is larger than 1)
		• Output is rounded to two decimal places
		
	3. Final output (price matrix):
		• Base price
		• Price with commission and tax (every instalment separately)
		• Tax amount (separately with every instalment)
		• Grand totals (sum of all instalments): Price with commission and tax, total tax sum
 * 
 * 
 */
 
require "class/insurance.php";
if(isset($_POST['submit']) && $_POST['submit']!='submit'){
	$insurance= new insurance();
	$insurance->calculate($_POST);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Insurance calculator</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.23.1" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
	
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" /><!-- adding basic css -->
</head>

<body>
	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="form-group centeralign">
					<h3>Car insurance calculator</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-8 col-sm-12 col-md-8">
					<label class="border border-danger bg-danger text-white">Note: Every Friday 15-20 o’clock, Base price will be 13% which is 11% otherwise</label>
				</div>
				<div class="col-4 col-sm-12 col-md-4 rightalign">
					<label class="border border-danger bg-danger text-white"><span>Today:</span> <?php echo date('m D Y H:i', time()); ?></label>
				</div>
			</div>
			<hr>
			<div class="row">
				<form action="" method="post" class="col-12 col-sm-12 col-md-12">
					<div class="form-group">
						<label for="exampleInputEmail1">Car's estimated value</label>
						<input type="number" class="form-control" min="100" max="100000" id="carcost" name="carcost" placeholder="Car's estimated value" value="<?=$_POST['carcost']?>" required>
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Tax percentage</label>
						<input type="number" value="<?=$_POST['tax']?>" name="tax" min="1" max="100" class="form-control" id="tax" placeholder="Tax percentage" required>
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Number of instalments</label>
						<input type="number" value="<?=$_POST['installments']?>" name="installments" min="1" max="12" class="form-control" id="installments" placeholder="Number of instalments" required>
					</div>
					<button type="submit" value="Submit" name="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
		<?php if(isset($_POST['submit']) && $_POST['submit']!='submit'){ ?>
			<div class="container scroll">
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12">
						<table class="table">
							<thead>
								<tr>
									<th></th>
									<th>Policy</th>
									<?php for($i=0;$i < $insurance->installments; $i++ ){ ?>
									<th>Installment <?=($i+1)?></th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Value</td>
									<td><?= $insurance->carcost;?></td>
									<?php for($i=0;$i < $insurance->installments; $i++ ){ ?>
									<td> - </td>
									<?php } ?>
								</tr>
								<tr>
									<td>Base price (<?= $insurance->basicpercentage;?>%)</td>
									<td><?= $insurance->basicprice;?></td>
									<?php for($i=0;$i < $insurance->installments; $i++ ){ ?>
									<td> <?=round(($insurance->basicprice/$insurance->installments), 2);?> </td>
									<?php } ?>
								</tr>
								<tr>
									<td>Commission (17%)</td>
									<td><?= $insurance->commission;?></td>
									<?php for($i=0;$i < $insurance->installments; $i++ ){ ?>
									<td> <?=round(($insurance->commission/$insurance->installments), 2);?> </td>
									<?php } ?>
								</tr>
								<tr>
									<td>Tax (<?= $insurance->tax;?>%)</td>
									<td><?= $insurance->taxamount;?></td>
									<?php for($i=0;$i < $insurance->installments; $i++ ){ ?>
									<td> <?=round(($insurance->taxamount/$insurance->installments), 2);?> </td>
									<?php } ?>
								</tr>
								<tr>
									<td><strong>Total Cost</strong></td>
									<td><strong><?= ($insurance->totalcost);?></strong></td>
									<?php for($i=0;$i < $insurance->installments; $i++ ){ ?>
									<td> <?=round(($insurance->totalcost/$insurance->installments), 2);?> </td>
									<?php } ?>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</body>

</html>
