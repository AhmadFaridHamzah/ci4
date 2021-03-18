<?php
echo form_open("film-management/update/".$film['film_id'],['class'=>'form-control']);
echo form_hidden('film_id',$film['film_id']);
?>
  <div class="form-group row">
    <?php 
        echo form_label('Title','title',['class'=>'col-sm-2 col-form-label']);
    ?>
    <div class="col-sm-10">
      <?php

        if(!empty(old('title'))){
          $value = old('title');
        }else{
          $value = $film['title'];
        }
        $valid = isset($validation['title'])? "is-invalid" : "";
        echo form_input('title',"$value",['class'=>"form-control $valid",'placeholder'=>'Insert title']);
      ?>

      <?php if(isset($validation['title'])) { ?>

        <div class="invalid-feedback d-block">
            <?= $validation['title'] ?>
        </div>

      <?php } ?>

    </div>
  </div>

  <div class="form-group row">
     <?php 
        echo form_label('Description','description',['class'=>'col-sm-2 col-form-label']);
    ?>
    <div class="col-sm-10">
        <?php
            if(!empty(old('description'))){
              $value = old('description');
            }else{
              $value = $film['description'];
            }
            $valid = isset($validation['description'])? "is-invalid" : "";

            echo form_textarea('description',"$value",['class'=>"form-control $valid",'placeholder'=>'Insert description']);
        ?>

        <?php if(isset($validation['description'])) { ?>

        <div class="invalid-feedback d-block">
            <?= $validation['description'] ?>
        </div>

        <?php } ?>
    </div>
  </div>

  <div class="form-group row">
     <?php 
        echo form_label('Release Year','release_year',['class'=>'col-sm-2 col-form-label']);
    ?>
    <div class="col-sm-10">
        <?php
             if(!empty(old('release_year'))){
              $value = old('release_year');
            }else{
              $value = $film['release_year'];
            };
            $valid = isset($validation['release_year'])? "is-invalid" : "";

            echo form_input('release_year',"$value",['class'=>"form-control $valid",'placeholder'=>'Insert Release Year'],'number');
        ?>

        <?php if(isset($validation['release_year'])) { ?>

        <div class="invalid-feedback d-block">
            <?= $validation['release_year'] ?>
        </div>

        <?php } ?>
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
            echo form_dropdown('rating',$rating,'',['class'=>'form-control','placeholder'=>'Insert Rating']);
        ?>
    </div>
  </div>
  
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Update</button>
    </div>
  </div>
<?php
echo form_close();
?>