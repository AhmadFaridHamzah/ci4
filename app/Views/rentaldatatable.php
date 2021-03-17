<?php
$rentalajax=site_url('/film/ajaxrental');

$session = session();
$keepsearch=$session->get('keepsearch');
// print_r($keepsearch);
?>

<script>
$(document).ready(function() {

<?php
if($keepsearch !=1){
?>
var table=$('#example').DataTable();
 table.state.clear();
 table.destroy();
<?php
}else{

    $session->remove('keepsearch');
}
?>

    $('#example').DataTable( {
        "processing": true,
        "serverSide": true,
        'stateSave':true,
        "ajax": "<?=$rentalajax?>",
        columnDefs: [
            
         { targets:0, orderable:false},    
        { targets:1, name:'f.title'},
        { targets:2, name:'c.first_name' },
        { targets:3, name:'s.first_name' },
        { targets:4, orderable:false},   
    ]
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