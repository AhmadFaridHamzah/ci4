<?php
echo form_open_multipart('upload/store',['class'=>'form-control']);
?>
    <div class="form-group row">
        <?php
        echo form_label('Upload','upload',['class'=>'col-sm-2 col-form-label']);
        ?>
        <div class="col-sm-10">
            <?php
            $valid = isset($validation['file_name'])? "is-invalid" : "";
            echo form_upload('file_name',"",['class'=>"form-control $valid",'placeholder'=>'Insert title']);
            ?>

            <?php if(isset($validation['file_name'])) { ?>

                <div class="invalid-feedback d-block">
                    <?= $validation['file_name'] ?>
                </div>

            <?php } ?>

        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </div>
<?php
echo form_close();
?>