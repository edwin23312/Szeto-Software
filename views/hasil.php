<p style="color:#000000;font-size:14px;text-align:right">Jakarta, <?=date("F d, Y")?>
</p>
<span style="color:#000000;font-size:16px;">
	<table width="600px">
		<tr>
			<td width="50px">To </td><td width='10px'>:</td><td><b><?=$send_to?></b></td>
		</tr>
		<tr>
			<td>Attn </td><td> : </td><td><b><?=$attn_to?></b></td>
		</tr>
	</table>
	<br />
	<table>
		<tr>
			<td width='80px'>Subject </td><td> : </td><td><b><?=$subject?></b></td>
		</tr>
	</table>
</span>


<br /><br />
Dear <?=$attn_to?>,<br /><br />
Please find the details of rate as below :

<br /><br /><br />
<b>LOCAL CHARGE AT KOREA</b>
<table border='1' cellspacing='0' width='100%'>
<tr>
	<td width='2%' style='text-align:center;'>No</td>
	<td width='40%' style='text-align:center;'>Kind Of Charge</td>
	<td width='20%' style='text-align:center;'>Rate (IDR)</td>
	<td width='35%' style='text-align:center;'>Remarks</td>
</tr>
	<?
	for($i=0;$i<count($field_name);$i++)
	{
	?>
	<tr>
		<td style='text-align:center;'><?=$i+1?></td>
		<td><?=$field_name[$i]?>
			
		</td>
		<td>	
			<?=$field_rate[$i]?>
		</td>
		<td>	
			<?=$field_remarks[$i]?>
		</td>
	</tr>
	<?
	}?>
</table>
	
<br /><br /><br />
<b>CUSTOM CLEARANCE IMPORT ( LCL -
AIR )</b>
<table border='1' cellspacing='0' width='100%'>
<tr>
	<td width='2%' style='text-align:center;'>No</td>
	<td width='40%' style='text-align:center;'>Kind Of Charge</td>
	<td width='20%' style='text-align:center;'>Rate (IDR)</td>
	<td width='35%' style='text-align:center;'>Remarks</td>
</tr>
	<?
	for($i=0;$i<count($field_name2);$i++)
	{
	?>
	<tr>
		<td style='text-align:center;'><?=$i+1?></td>
		<td><?=$field_name2[$i]?>
			
		</td>
		<td>	
			<?=$field_rate2[$i]?>
		</td>
		<td>	
			<?=$field_remarks2[$i]?>
		</td>
	</tr>
	<?
	}
	?>
</table>

<br /><br /><br />

Remarks : <br />
<table>
	<?
	foreach($field_remarks3 as $key => $value)
	{
	?>
	<tr>
		<td>&nbsp;</td><td>-</td><td><?=$value?></td>
	</tr>
	<?
	}
	?>
</table>


<br /><br />

Hope rate above workable enough to your requirement.
We are looking forward your kind support to <b>PT SZETO GLOBAL INDONESIA</b>.<br />
If any question or further information, please feel free to contact us., thank you
<br /><br /><br />

Best Regards,
<br /><br /><br />
<b><u><?=$created_by?></u></b><br />
<?=$jabatan?>