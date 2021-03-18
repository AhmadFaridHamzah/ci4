<?php

function get_language(){
    $model = new \App\Models\LanguageModel();

    $data = $model->findAll();

    if(!empty($data)){
        foreach($data as $value){

            $language[$value['language_id']] = $value['name'];

        }
    }

    return $language;
}

?>