<?php

const FILE_PATH = __DIR__ . '/podaci/polaznici.txt';

try {
    if(!file_exists(FILE_PATH)){
        throw new Exception("File doesnt exist: " . FILE_PATH);
    }
    if(is_dir(FILE_PATH)){
        throw new Exception("This is not a file: " . FILE_PATH);
    }

    $pointer = fopen(FILE_PATH, 'r');
    if($pointer === false){
        throw new Exception("Unable to open the file: " . FILE_PATH);
    }

    if(false !== $pointer){
        while (false !== $line = fgets($pointer)) {
            echo $line . '<br>';
        }
    
        fclose($pointer);
    }else{
        echo 'Unable to open the file.';
    }
} catch (\Exception $exception) {
    echo $exception->getMessage();
}

