<?php
function inputFilter($data){
  $data=trim($data);
  $data=stripslashes($data);
  $data=htmlspecialchars($data);
  return $data;
}
function validate($dirty_string, $validate_method){
  switch($validate_method){
    case 'int':
    if(is_numeric($dirty_string) && $dirty_string > 0){
      return $dirty_string;
    }
    return false;
    break;
    case 'char':
    if(!is_numeric($dirty_string)){
      return $dirty_string;
    }
    return false;
    break;
    case 'alphanum':
    if(!preg_match('/[\'.,:;*?~`! @#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/',$dirty_string)){
      return $dirty_string;
    }
    return false;
    break;
    case 'datetime':
    $data = DateTime::createFromFormat('Y/m/d H:i:s', $dirty_string);
    if($data != false){
      return $date -> format('Y-m-d H:i:s');
    }
    return false;
    default:
    return false;
    break;
  }
}



?>
