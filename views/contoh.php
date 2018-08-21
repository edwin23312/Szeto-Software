<?
include "header.php";
?>
<table width="100%"><tr>
<td width="12%"></td>
<td width="76%">
	<div id="bodycontent">
    	<div id="path">Test Program</div>
            <div id="personal">
               	<div id='show_message'></div>
           		<?	echo modules::run('testing/contoh_form');?>
             <div id="clear"></div>
            </div><br />
    </div> <!--/ content -->
</td>
<td width="12%">
</td>
</tr>
</table>
   <div id="clear"></div>
   
<?
	include "footer2.php";
?>