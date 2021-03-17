



<table class='table'>
<tr>
<th>no</th>
<th>title</th>
<th>customer name</th>
<th>staff name</th>
</tr>
<?php

foreach($list_data as $row){
?>
<tr>
<td><?=$start?></td>
<td><?=$row['title']?></td>
<td><?=$row['customer_name']?></td>
<td><?=$row['staff_name']?></td>
</tr>



<?php
$start++;
}

?>
</table>

<?php
if($pagination_link){

    $pagination_link->setPath('film/rental');

    echo  $pagination_link->links();

}

?>