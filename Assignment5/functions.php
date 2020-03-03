<?php
function jsonToArray(string $file){
	return json_decode(file_get_contents($file),true);
}
function showItem($id,$name,$location,$picture='https://via.placeholder.com/140x100'){
	 echo '<div class="media">
              <img src="'.$picture.'" class="mr-3" alt="'.$name.'"width="90">
              <div class="media-body">
                <h5 class="mt-0">'.$name.'</h5>
                located in '.$location.'
                <br>
                <a href="details.php?id='.$id.'">About</a>
                <br>
                <a href="delete.php?id='.$id.'">Delete</a>
                <br>
                <a href="modify.php?id='.$id.'">Modify</a>              
              </div>
              </div>';
}