<?php
$GLOBALS['globalVar'] = 0;

function setGlobalVariable($input)
{
  $GLOBALS['globalVar'] = $input;
}

function getGlobalVariable()
{
  return $GLOBALS['globalVar'];
}


if (getGlobalVariable() === 0) {
  echo "<div class=\"genre-container\">
          <a href=\"index.php?type=job\" class=\"genre\" id=\"job\"><span>Job</span></a>
          <!-- <a href=\"index.php?type=project\" class=\"genre\"><span>Project</span></a> -->
          <a href=\"index.php?type=contest\" class=\"genre\"><span>Contest</span></a>
          <a href=\"index.php?type=profile\" class=\"genre\"><span>Profile</span></a>
        </div>";
} else if (getGlobalVariable() === 1) {
  echo "<div class=\"genre-container\">
          <a href=\"index.php?type=job\" class=\"genre\" id=\"job\"><span>Job</span></a>
          <!-- <a href=\"index.php?type=project\" class=\"genre\"><span>Project</span></a> -->
          <a href=\"index.php?type=contest\" class=\"genre\"><span>Contest</span></a>
          <a href=\"index.php?type=profile\" class=\"genre\"><span>Profile</span></a>
        </div>";
} else if (getGlobalVariable() === 2) {
  echo "<div class=\"genre-container\">
          <a href=\"index.php?type=job\" class=\"genre\" id=\"job\"><span>Job</span></a>
          <!-- <a href=\"index.php?type=project\" class=\"genre\"><span>Project</span></a> -->
          <a href=\"index.php?type=contest\" class=\"genre\"><span>Contest</span></a>
          <a href=\"index.php?type=profile\" class=\"genre\"><span>Profile</span></a>
        </div>";
} else if (getGlobalVariable() === 3) {
  echo "<div class=\"genre-container\">
          <a href=\"index.php?type=job\" class=\"genre\" id=\"job\"><span>Job</span></a>
          <!-- <a href=\"index.php?type=project\" class=\"genre\"><span>Project</span></a> -->
          <a href=\"index.php?type=contest\" class=\"genre\"><span>Contest</span></a>
          <a href=\"index.php?type=profile\" class=\"genre\"><span>Profile</span></a>
        </div>";
}
?>