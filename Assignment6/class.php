<?php

class json{
static function readJSON($file,$index=null){
	$h=fopen($file,'r');
	$output='';
	while(!feof($h)) $output.=fgets($h);
	fclose($h);
	$output=json_decode($output,true);
	return !isset($index) ? $output : (isset($output[$index]) ? $output[$index] : null);
}
static function writeJSON($file,$data){
	$h=fopen($file,'w+');
	fwrite($h,json_encode($data));
	fclose($h);
}
}
class userAction{
	private $fileName;
	

	public function __construct($fileName){
		$this->fileName=$fileName;
	}

	public function create($data){
		$array=json::readJSON($this->fileName);
		$array[count($array)]=$data;
		json::writeJSON($this->fileName,$array);
	}
	public function delete($index){
		$array=json::readJSON($this->fileName);
		unset($array[$index]);
		$array2=array_values($array);
		json::writeJSON($this->fileName,$array2);
	}
	public function modify($index){
			$array=json::readJSON($this->fileName);
			$array[$index]=$_POST;
			unset($array[$index]['id']);
			$array2 = array_values($array);
			json::writeJSON($this->fileName,$array2);
			

	}

}
class Org {
    private $name;
    private $location;
    private $type;
    private $picture;
    private $about;
    private $website;

    public function __construct($name,$location,$type,$picture,$about,$website){
      $this->name=$name;
      $this->location=$location;
      $this->type=$type;
      $this->picture=$picture;
      $this->about=$about;
      $this->website=$website;
    }
    public function getName(){
      return $this->name;
    }
    public function getLocation(){
      return $this->location;
    }
    public function getPicture(){
      return $this->picture;
    }
     public function getType(){
      return $this->type;
    }
    public function getAbout(){
      return $this->about;
    }
    public function getWebsite(){
      return $this->website;
    }
}