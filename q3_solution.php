<?php
/* =======================
   CONFIGURE THESE FIRST
   ======================= */
$servername = "localhost";
$username   = "username";
$password   = "";

/* ---------- helper ---------- */
function hr() { echo "<hr style='margin:16px 0;'>"; }
function h($s){ return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }

/* ---------- 0) connect (server level), create DB ---------- */
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$dbname = "uiutech_final";
if (!$conn->query("CREATE DATABASE IF NOT EXISTS `$dbname`")) {
  die("Failed to create database: " . $conn->error);
}
$conn->close();

/* ---------- reconnect to the new DB ---------- */
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

/* ---------- 1) create table + seed data ---------- */
$createTableSql = "
CREATE TABLE IF NOT EXISTS employee_final (
  EmployeeID INT PRIMARY KEY,
  EmployeeName VARCHAR(100) NOT NULL,
  DepartmentID INT NOT NULL,
  DepartmentName VARCHAR(100) NOT NULL,
  Salary INT NOT NULL,
  PerformanceRating CHAR(1) NOT NULL CHECK (PerformanceRating IN ('A','B','C','D'))
);
";
if (!$conn->query($createTableSql)) {
  die("Failed creating table: " . $conn->error);
}

/* put the exact rows from the prompt — reset contents for a clean run */
if (!$conn->query("TRUNCATE TABLE employee_final")) {
  die("Failed to truncate: " . $conn->error);
}

$seed = $conn->prepare("
  INSERT INTO employee_final
    (EmployeeID, EmployeeName, DepartmentID, DepartmentName, Salary, PerformanceRating)
  VALUES
    (?,?,?,?,?,?)
");
$seed->bind_param("isiisi", $id, $name, $deptId, $deptName, $salary, $rating);

$data = [
  [1, "Arif Rahman",   201, "Software Development", 45000, "B"],
  [2, "Marium Khan",   201, "Software Development", 52000, "A"],
  [3, "Sabbir Hossain",202, "Quality Assurance",     38000, "C"],
  [4, "Samira Begum",  203, "UI/UX Design",          42000, "B"],
];
foreach ($data as $row) {
  [$id, $name, $deptId, $deptName, $salary, $rating] = $row;
  if (!$seed->execute()) { die("Insert failed: " . $conn->error); }
}
$seed->close();

echo "<h2>Q3 — PHP & MySQL Solution</h2>";

/* ---------- Task 1 ----------
   Show total number of employees for each performance rating (A,B,C,D) */
hr();
echo "<h3>1) Employees by Performance Rating</h3>";
$sql1 = "
  SELECT PerformanceRating, COUNT(*) AS total
  FROM employee_final
  GROUP BY PerformanceRating
  ORDER BY PerformanceRating
";
$res1 = $conn->query($sql1);
if ($res1 && $res1->num_rows > 0) {
  echo "<table border='1' cellpadding='6' cellspacing='0'>
        <tr><th>PerformanceRating</th><th>Total Employees</th></tr>";
  while ($r = $res1->fetch_assoc()) {
    echo "<tr><td>".h($r['PerformanceRating'])."</td><td>".h($r['total'])."</td></tr>";
  }
  echo "</table>";
} else {
  echo "No data.";
}

/* ---------- Task 2 ----------
   If salary < 40,000 AND current rating != 'D', change rating to 'C' */
hr();
echo "<h3>2) Update Ratings for Low Salaries</h3>";
$sql2 = "
  UPDATE employee_final
  SET PerformanceRating = 'C'
  WHERE Salary < 40000 AND PerformanceRating <> 'D'
";
if ($conn->query($sql2) === TRUE) {
  echo "Ratings updated for employees with Salary &lt; 40,000 and not already 'D'. Rows affected: " . $conn->affected_rows;
} else {
  echo "Error updating ratings: " . h($conn->error);
}

/* ---------- Task 3 ----------
   If salary > 50,000 add 5,000 bonus, but only if resulting salary <= 60,000 */
hr();
echo "<h3>3) Apply 5,000 BDT Bonus (guarded at 60,000 cap)</h3>";
$sql3 = "
  UPDATE employee_final
  SET Salary = Salary + 5000
  WHERE Salary > 50000
    AND Salary + 5000 <= 60000
";
if ($conn->query($sql3) === TRUE) {
  echo "Bonus applied where eligible. Rows affected: " . $conn->affected_rows;
} else {
  echo "Error applying bonus: " . h($conn->error);
}

/* ---------- Task 4 ----------
   For each department, display department name and number of employees,
   sorted by number of employees (largest first) */
hr();
echo "<h3>4) Employees per Department (largest first)</h3>";
$sql4 = "
  SELECT DepartmentName, COUNT(*) AS NumEmployees
  FROM employee_final
  GROUP BY DepartmentID, DepartmentName
  ORDER BY NumEmployees DESC, DepartmentName ASC
";
$res4 = $conn->query($sql4);
if ($res4 && $res4->num_rows > 0) {
  echo "<table border='1' cellpadding='6' cellspacing='0'>
        <tr><th>Department</th><th>Employees</th></tr>";
  while ($r = $res4->fetch_assoc()) {
    echo "<tr><td>".h($r['DepartmentName'])."</td><td>".h($r['NumEmployees'])."</td></tr>";
  }
  echo "</table>";
} else {
  echo "No data.";
}

hr();
/* show final state of the table for verification */
echo "<h3>Final Table State</h3>";
$resAll = $conn->query("SELECT * FROM employee_final ORDER BY EmployeeID");
if ($resAll && $resAll->num_rows > 0) {
  echo "<table border='1' cellpadding='6' cellspacing='0'>
        <tr>
          <th>ID</th><th>Name</th><th>Dept ID</th><th>Department</th>
          <th>Salary</th><th>Rating</th>
        </tr>";
  while ($r = $resAll->fetch_assoc()) {
    echo "<tr>
      <td>".h($r['EmployeeID'])."</td>
      <td>".h($r['EmployeeName'])."</td>
      <td>".h($r['DepartmentID'])."</td>
      <td>".h($r['DepartmentName'])."</td>
      <td>".h($r['Salary'])."</td>
      <td>".h($r['PerformanceRating'])."</td>
    </tr>";
  }
  echo "</table>";
}

$conn->close();
?>
