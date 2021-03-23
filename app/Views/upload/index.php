<?php
$rentalajax=site_url('/upload/ajaxuploaddt');

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
                { targets:1, name:'file_name'},
                { targets:2, name:'file_ext' },
                { targets:3, name:'path' },
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



<a class="btn btn-success" href="<?= site_url('upload/create') ?>" role="button">Create</a>
<br><br>

<table id="example" class="display" style="width:100%">
    <thead>
    <tr>
        <th>NO</th>
        <th>File Name</th>
        <th>Extension</th>
        <th>Path</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>NO</th>
        <th>File Name</th>
        <th>Extension</th>
        <th>Path</th>
    </tr>
    </tfoot>
</table>