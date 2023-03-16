<?php

 function containLetters(string $firstWord, string $secondWord){

        $cek = [];
        for ($i=0; $i <strlen($secondWord) ; $i++) { 
            for ($j=0; $j <strlen($firstWord) ; $j++) { 
              
                if($secondWord[$i] == $firstWord[$j]) {

                    array_push($cek, [
                        'kata'=> $firstWord[$j],
                        'ada' => true,
                    ]);
                }
            }
        }
        if(count($cek) == strlen($firstWord) ){
            return true;
        }
        else{
            return false;
        }

    }