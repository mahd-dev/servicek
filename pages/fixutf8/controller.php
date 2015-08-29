<?php

  function escapestr($value){
    global $db;
    return ($value===null?"NULL":"'".$db->real_escape_string(urldecode(Encoding::fixUTF8($value)))."'");
  }

  $q=$db->query("select id, name from category");
  while($r=$q->fetch_row()) $db->query("update category set name=".escapestr($r[1])." where id=".$r[0]);

  $q=$db->query("select id, name, slogan, description, url from company");
  while($r=$q->fetch_row()) $db->query("update company set name=".escapestr($r[1]).", slogan=".escapestr($r[2]).", description=".escapestr($r[3]).", url=".escapestr($r[4])." where id=".$r[0]);

  $q=$db->query("select id, name, address, email from company_seat");
  while($r=$q->fetch_row()) $db->query("update company_seat set name=".escapestr($r[1]).", address=".escapestr($r[2]).", email=".escapestr($r[3])." where id=".$r[0]);

  $q=$db->query("select id, name, description, url, address, email from job");
  while($r=$q->fetch_row()) $db->query("update job set name=".escapestr($r[1]).", description=".escapestr($r[2]).", url=".escapestr($r[3]).", address=".escapestr($r[4]).", email=".escapestr($r[5])." where id=".$r[0]);

  $q=$db->query("select id, title from job_cv");
  while($r=$q->fetch_row()) $db->query("update job_cv set title=".escapestr($r[1])." where id=".$r[0]);

  $q=$db->query("select id, title, description, at, location from job_cv_item");
  while($r=$q->fetch_row()) $db->query("update job_cv_item set title=".escapestr($r[1]).", description=".escapestr($r[2]).", at=".escapestr($r[3]).", location=".escapestr($r[4])." where id=".$r[0]);

  $q=$db->query("select id, title, description from job_cv_item_project");
  while($r=$q->fetch_row()) $db->query("update job_cv_item_project set title=".escapestr($r[1]).", description=".escapestr($r[2])." where id=".$r[0]);

  $q=$db->query("select id, title, description from job_skill");
  while($r=$q->fetch_row()) $db->query("update job_skill set title=".escapestr($r[1]).", description=".escapestr($r[2])." where id=".$r[0]);

  $q=$db->query("select id, name, description from portfolio");
  while($r=$q->fetch_row()) $db->query("update portfolio set name=".escapestr($r[1]).", description=".escapestr($r[2])." where id=".$r[0]);

  $q=$db->query("select id, name, description from product");
  while($r=$q->fetch_row()) $db->query("update product set name=".escapestr($r[1]).", description=".escapestr($r[2])." where id=".$r[0]);

  $q=$db->query("select id, name, description from service");
  while($r=$q->fetch_row()) $db->query("update service set name=".escapestr($r[1]).", description=".escapestr($r[2])." where id=".$r[0]);

  $q=$db->query("select id, name, description, url, address, email from shop");
  while($r=$q->fetch_row()) $db->query("update shop set name=".escapestr($r[1]).", description=".escapestr($r[2]).", url=".escapestr($r[3]).", address=".escapestr($r[4]).", email=".escapestr($r[5])." where id=".$r[0]);
?>
