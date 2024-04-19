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
}
?>        