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


function get_rating(){
    $data = [
        'G' => 'G',
        'PG' => 'PG',
        'PG-13' => 'PG-13',
        'R'=>'R',
        'NC-17'=>'NC-17'
    ];

    return $data;
}

?>