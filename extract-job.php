<?php

$count = 0;

$sql_featured = "SELECT * FROM job_posts ORDER BY date DESC";
$result_featured = $conn->query($sql_featured);
if ($result_featured->num_rows > 0) {
  while ($row = $result_featured->fetch_assoc()) {
    if ($row["featured"] == '1') {
      $job_id = $row["job_id"];
      $companyName = $row["company_name"];
      $companyLogo = $row["company_logo"];
      $companyLocation = $row["location"];
      $jobTitle = $row["job_title"];
      $date = $row["date"];
      $noOfPeopleApplied = $row["no_of_people_applied"];
      $salary = $row["salary"];
      $salary101 = $salary / 1000;

      $diff = date_diff(date_create($currentDate), date_create($date));
      $daysAgo = $diff->format("%a");

      $dateDisplay = ($daysAgo == 0) ? "Today" : "$daysAgo days ago";

      echo '
    <div class="Featured-Job" id="Featured-Job' . $count . '">
        <div class="Company-Cross-Container">
            <div class="Company-Logo-Name-Container">
                <div class="Company-Logo-Container">
                    <img class="Company-Logo" src="' . $companyLogo . '" />
                </div>
                <div class="Company-Name">' . $companyName . '</div>
            </div>
            <img class="Cross" onclick="hideJob(' . $count . ')" src="styles/marketplace/cross.png">
        </div>
        <div class="Job-Title-Container">

        <a href="http://localhost/job-practice/job-description/job-description.php?job_id=' . $job_id . '"
style="text-decoration: none; outline: none;"> <div class="Job-Title">' . $jobTitle . '</div></a>

</div>
<div class="Salary-Applied-Location-Time-Container">
  <div class="Salary-Applied-Number-Container">
    <div class="Salary-Container">
      <img class="Salary-Icon" src="styles/marketplace/salary icon.png" />
      <div class="Salary">' . $salary101 . 'k</div>
    </div>
    <div class="Applied-Number-Container">
      <img class="Applied-Number-Icon" src="styles/marketplace/applied-number-icon.png">
      <div class="Applied-Number">' . $noOfPeopleApplied . ' Applied</div>
    </div>
  </div>
  <div class="Location-Time-Container">
    <div class="Location-Container">
      <img class="Location-Icon" src="styles/marketplace/location-icon.png">
      <div class="Location">' . $companyLocation . '</div>
    </div>
    <div class="Time-Container">
      <img class="Time-Icon" src="styles/marketplace/time-icon.png">
      <div class="Time">' . $dateDisplay . '</div>
    </div>
  </div>
</div>
</div>';
      $count = $count + 1;
    }
  }
} else {
  echo "No job posts found.";
}


echo ' </div>
<div class="Featured-text-container">
  <div class="Featured-text">Featured</div>
</div>
<div class="right-div">
</div>
</div>

<div class="Job-Section1">';




$sql = "SELECT job_posts.*, admins.AdminUN, admins.AdminFN, admins.AdminDP
  FROM job_posts
  JOIN admins ON job_posts.admin_id = admins.admin_id
  WHERE job_posts.featured = '0'
  ORDER BY job_posts.date DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    if ($row["featured"] == '0') {
      $job_id = $row["job_id"];
      $companyName = $row["company_name"];
      $jobTitle = $row["job_title"];
      $hashtags = $row["hashtags"];
      $companyLocation = $row["location"];
      $date = $row["date"];
      $noOfPeopleApplied = $row["no_of_people_applied"];
      $companyLogo = $row["company_logo"];
      $adminUN = $row["AdminUN"];
      $adminFN = $row["AdminFN"];
      $adminDP = $row["AdminDP"];
      $salary = $row["salary"];
      $salary101 = $salary / 1000;

      $diff = date_diff(date_create($currentDate), date_create($date));
      $daysAgo = $diff->format("%a");

      $dateDisplay = ($daysAgo == 0) ? "Today" : "$daysAgo days ago";

      // /*<img src="styles/job/job-tag.png" id="job-tag" class="job-tag">*/ tag image in html

      echo ' <div class="Job2">
    <div class="Admin-Company-Container3">
      <div class="Admin-Container4">
        <img class="Admin-Photo5" src="' . $adminDP . '" />
        <div class="Admin-Name-Container6">
          <div class="Admin-Username-Tag-Container7">
            <div class="Admin-Username8">' . $adminUN . '</div>
            <div class="Admin-Tag9">
              <div class="Admin10">ADMIN</div>
            </div>
          </div>
          <div class="Admin-Name11">' . $adminFN . '</div>
        </div>
      </div>
    </div>
    <div class="Job-Container14">
      <div class="Job-Title-Location-Container15">
        <div class="Job-Title16">' . $jobTitle . '</div>
        <div class="Company-Logo-Name-Container101">
          <div class="Company-Logo-Container101">
            <img class="Company-Logo101" src="' . $companyLogo . '" />
          </div>
          <div class="Company-Name101">' . $companyName . '</div>
        </div>
      </div>
      <div class="Hashtag-Salt-Container18">
        <div class="Job-Hashtag-Container19">';
      $hashtagsArray = explode("#", $hashtags);
      foreach ($hashtagsArray as $tag) {
        if (!empty($tag)) {
          echo '<p class="Hashtag20"><span class="Job-Hashtag21">' . $tag . '</span> </p>';
        }
      }
      echo '</p>';
      echo ' </div>
        <div class="Salt-Container22">
          <div class="Salary-Applied-Number-Container23">
            <div class="Salary-Container24">
              <img class="Salary-Icon25" src="styles/job/salary icon.png" />
              <div class="Salary26">' . $salary101 . 'k</div>
            </div>
            <div class="Applied-Number-Container27">
              <img class="Applied-Number-Icon28" src="styles/job/applied-number-icon.png" />
              <div class="Applied-Number29">' . $noOfPeopleApplied . ' Applied</div>
            </div>
          </div>
          <div class="Time-Location-Container30">
            <div class="Location-Container31">
              <img class="Location-Icon32" src="styles/job/location-icon.png">
              <div class="Location33">' . $companyLocation . '</div>
            </div>
            <div class="Time-Container34">
              <img class="Time-Icon35" src="styles/job/time-icon.png">
              <div class="Time36">' . $dateDisplay . '</div>
            </div>
          </div>
        </div>
      </div>
      <button class="View-Details-Button37 View-Details38">
      <a href="http://localhost/job-practice/job-description/job-description.php?job_id=' . $job_id . '" style="text-decoration: none; outline: none; color: #87c232;"> View details</a>
      </button>
    </div>
  </div>';
    }

  }
} else {
  echo "No job posts found.";
}

// Close the connection (optional)
$conn->close();
?>