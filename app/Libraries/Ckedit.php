<?php
namespace App\Libraries;
  class Ckedit 
  {
    public function ckcan($division)
      {
        if($division == $_SESSION['usertbl']['division_id']){
            $cedit = 'can';
        }else{
            $cedit = 'cant';
        }
        return $cedit;
    }
    public function ckacan($level)
      {
        if($level == $_SESSION['usertbl']['level']){
            $caedit = 'can';
        }else{
            $caedit = 'cant';
        }
        return $caedit;
    }
}
?>        