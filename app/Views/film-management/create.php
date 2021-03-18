<?php
echo form_open('film-management/store',['class'=>'form-control']);
?>
  <div class="form-group row">
    <?php 
        echo form_label('Title','title',['class'=>'col-sm-2 col-form-label']);
    ?>
    <div class="col-sm-10">
      <?php
        echo form_input('title','',['class'=>'form-control','placeholder'=>'Insert title']);
      ?>

    </div>
  </div>

  <div class="form-group row">
     <?php 
        echo form_label('Description','description',['class'=>'col-sm-2 col-form-label']);
    ?>
    <div class="col-sm-10">
        <?php
            echo form_textarea('description','',['class'=>'form-control','placeholder'=>'Insert description']);
        ?>
    </div>
  </div>

  <div class="form-group row">
     <?php 
        echo form_label('Release Year','release_year',['class'=>'col-sm-2 col-form-label']);
    ?>
    <div class="col-sm-10">
        <?php
            echo form_input('release_year','',['class'=>'form-control','placeholder'=>'Insert Release Year'],'number');
        ?>
    </div>
  </div>

  <div class="form-group row">
     <?php 
        echo form_label('Language','language_id',['class'=>'col-sm-2 col-form-label']);
    ?>
    <div class="col-sm-10">
        <?php
            echo form_dropdown('language_id',$language,'',['class'=>'form-control','placeholder'=>'Insert Language']);
        ?>
    </div>
  </div>

  <div class="form-group row">
     <?php 
        echo form_label('Rating','rating',['class'=>'col-sm-2 col-form-label']);
    ?>
    <div class="col-sm-10">
        <?php
            echo form_dropdown('rating','','',['class'=>'form-control','placeholder'=>'Insert Rating']);
        ?>
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