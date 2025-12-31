<?php
include 'config.php';

$currentDate = date('Y-m-d');

if (isset($_GET['type'])) {
  $type = $_GET['type'];

  if ($type == 'profile') {
    echo '<p>This genre is under-construction.</p>';
  } elseif ($type == 'job') {
    include 'extract-job.php';
  } elseif ($type == 'contest') {
    echo '<p>This genre is under-construction.</p>';
  }

  echo '</div>';
}
?>