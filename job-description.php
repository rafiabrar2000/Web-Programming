<?php

if (isset($_GET['job_id'])) {
  $job_id = $_GET['job_id'];

  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "marketplace_page";

  // Create a connection
  $mysqli = new mysqli($servername, $username, $password, $database);

  // Check connection
  if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
  }

  $query = "SELECT * FROM job_posts WHERE job_id = " . $job_id . " ORDER BY date DESC";
  $result_job_des = $mysqli->query($query);

  if ($result_job_des->num_rows > 0) {
    while ($row = $result_job_des->fetch_assoc()) {
      $job_id = $row["job_id"];
      $companyName = $row["company_name"];
      $companyLogo = $row["company_logo"];
      $companyLocation = $row["location"];
      $jobTitle = $row["job_title"];
      $date = $row["date"];
      $noOfPeopleApplied = $row["no_of_people_applied"];
      $hashtags = $row["hashtags"];
      $location = $row["location"];


      $currentDate = date('Y-m-d');

      $diff = date_diff(date_create($currentDate), date_create($date));
      $daysAgo = $diff->format("%a");

      $dateDisplay = ($daysAgo == 0) ? "Today" : "$daysAgo days ago";

      // echo "Job ID: $job_id<br>";
      // echo "Company: $companyName<br>";
      // echo "Logo: $companyLogo<br>";
      // echo "Location: $companyLocation<br>";
      // echo "Job Title: $jobTitle<br>";
      // echo "Date: $date<br>";
      // echo "Number of Applicants: $noOfPeopleApplied<br>";

      include 'job_desc.php';
    }
  } else {
    echo "No job found with the given ID.";
  }

  $mysqli->close();
}
?>