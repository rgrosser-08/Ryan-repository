<?php

function showItem($id,$name,$location,$picture='https://via.placeholder.com/140x100'){
	 echo '<div class="media">
              <img src="'.$picture.'" class="mr-3" alt="'.$name.'"width="90">
              <div class="media-body">
                <h5 class="mt-0">'.$name.'</h5>
                located in '.$location.'
                <br>
                <a href="details.php?id='.$id.'">About</a>
                
             
              </div>
              </div>';
}