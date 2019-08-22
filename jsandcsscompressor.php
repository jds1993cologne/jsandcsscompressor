<?php

use MatthiasMullie\Minify;

function compressAndCombine($path, $type, $filearray){

  //TODO Path is given buggy
  $path = substr($path, 1);
  
  $pathParts = explode("___", $path);
  
  for ($i = 0; $i < sizeOf($pathParts); $i++){
    $files[$i] = $filearray[$pathParts[$i]];
  }
  
  if ($type == "js"){
    combineJSFiles($files);
  } else {
    combineCSSFiles($files);
  }
  
} 

function combineJSFiles($files){
  
  header("Content-type: text/javascript");

  //TODO Hier Quelltext einf&uuml;gen
  $minifier = new Minify\JS($files[0]);
  
  for($i = 1; $i < sizeOf($files); $i++){
    $minifier->add($files[$i]);
  }

  echo $minifier->minify();
  
}

function combineCSSFiles($files){
  
  header("Content-type: text/css");
  
  //TODO Hier Quelltext einf&uuml;gen
  $minifier = new Minify\CSS($files[0]);
  
  for($i = 1; $i < sizeOf($files); $i++){
    $minifier->add($files[$i]);
  }
  
  echo $minifier->minify();

}

?>