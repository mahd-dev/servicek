<?php
  $from = new locality($_GET["from"]);
  $to = new locality($_GET["to"]);
  foreach ($from->childrens as $sl) {
    $sl->parent = $to;
  }
  $from->delete_if_empty();
?>
