<?php
namespace App\Controllers;
use App\Models\firstmodel;
use Hermawan\DataTables\DataTable;

$showModel = new showmodel();
      $ShowModel
        ->select('meeting_id, meeting.created_at as created_at, meeting_date, meeting_name, meeting_no, subscriber_editor')
      ;
      return DataTable::of($ShowModel)
        ->toJson();

?>