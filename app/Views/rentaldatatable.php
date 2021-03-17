<?php
$rentalajax=site_url('/film/ajaxrental');
?>

<script>
$(document).ready(function() {
    $('#example').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "<?=$rentalajax?>"
    } );
} );
</script>

<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Title</th>
                <th>customer name</th>
                <th>staff name</th>
                <th>action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>NO</th>
                <th>Title</th>
                <th>customer name</th>
                <th>staff name</th>
                <th>action</th>
            </tr>
        </tfoot>
    </table>