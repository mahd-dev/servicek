<?php
  foreach (company_seat::get_all() as $cs) {
    $loc = json_decode($cs->geolocation);
    locality::fill($loc->latitude, $loc->longitude, $cs);
  }
  foreach (shop::get_all() as $cs) {
    $loc = json_decode($cs->geolocation);
    locality::fill($loc->latitude, $loc->longitude, $cs);
  }
  foreach (job::get_all() as $cs) {
    $loc = json_decode($cs->geolocation);
    locality::fill($loc->latitude, $loc->longitude, $cs);
  }
?>
