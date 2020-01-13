<?php
include('connection_db.php');

class sessionClass{
  private $last_time;
  private $last_times = Array();

  public function __construct(){
    //$a and $b are values brought in
    //from outside when we new the object
  }
  public function check_lsecond(){
    //if last time equals now
    if($this -> last_time == time()){
      $this -> last_time = time();
      return true;
    }else{
      //set new time to last time
      $this -> last_time = time();
      return false;
    }
  }
  public function check_24h(){
    //only need to check the data visited more than 10 times
    $size = count($this -> last_times);
    //only chek at least visited more than 100 times
    if($size > 100){
      //if($size > 1000){
      //get record of 11 times earlier than now
      $before11 = $this -> last_times[$size-11];
      //if the time of 11 times earlier less than last 24hrs(86400secoends)
      if ($before11 > time() - 86400){
        //add this time into array
        $this -> last_times[] = time();
        //we are visited more than 10 times in last 24hrs
        return true;
      }
    }
    //add this time into array
    $this -> last_times[] = time();
    //var_dump( $this -> last_times );
    return false;
  }

  public function domainLocked(){
    //domain Lock our web service
    if(!isset($_SERVER['HTTP_REFERER'])){
      return true;
    }else{
      if(!strcmp(substr($_SERVER['REQUEST_URI'],0,5),'/Libr')==0){
        return true;
      }
      return false;
    }
  }

  public function logRequest($ip, $time, $action){
    //Logging feature that accounts for every request with IP, browser, timestamp and action
    $dblogObj = new dbFunctiondClass();
    //getting browser//
    $headers=array();
    foreach($_SERVER as $name=> $value){
      $headers[$name]=$value;
    }
    $dblogObj -> addLog($ip,$headers['HTTP_USER_AGENT'], $time, $action);
  }
}
?>
