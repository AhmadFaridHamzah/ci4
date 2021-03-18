<?php
$rentalajax=site_url('/filmmanagement/ajaxfilmdt');

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
        { targets:1, name:'title'},
        { targets:2, name:'description' },
        { targets:3, name:'release_year' },
        { targets:4, name:'l.name' },
        { targets:5, name:'rating' },
        { targets:6, orderable:false},   
    ]
    } );
} );
</script>

<?php
    if(session()->has('message')){
    ?>

    <div class="alert <?= session()->getFlashdata('alert-class'); ?>">
        <?= session()->getFlashdata('message'); ?>
    </div>


<?php
    }
?>



<a class="btn btn-success" href="<?= site_url('film-management/create') ?>" role="button">Create</a>
<br><br>

<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Title</th>
                <th>Description</th>
                <th>Release Year</th>
                <th>Language</th>
                <th>Rating</th>
                <th>Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>NO</th>
                <th>Title</th>
                <th>Description</th>
                <th>Release Year</th>
                <th>Language</th>
                <th>Rating</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>