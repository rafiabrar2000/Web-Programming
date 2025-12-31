<?php
  $Attendees = $_POST['Attendees'];
  $CostperPerson = $_POST['CostperPerson'];
  $VenueCapacity = $_POST['VenueCapacity'];

  

  $TotalVenues = ceil($Attendees / $VenueCapacity);
  echo 'Total Venues:' . $TotalVenues . '<br>';

  $FullyOccupiedVenues = floor($Attendees / $VenueCapacity);

  echo 'FullyOccupiedVenues:' . $FullyOccupiedVenues . '<br>';
  
  $PartialOccupiedVenues = $TotalVenues - $FullyOccupiedVenues;

  echo 'PartialOccupiedVenues:' . $PartialOccupiedVenues . '<br>';

  $FulledSeatsInFullyOccupiedVenues = $FullyOccupiedVenues * $VenueCapacity;

  echo 'FulledSeatsInFullyOccupiedVenues:' . $FulledSeatsInFullyOccupiedVenues . '<br>';

  $RemainAttendee = $Attendees - $FulledSeatsInFullyOccupiedVenues;

  echo 'RemainAttendee:' . $RemainAttendee . '<br>';

  if($RemainAttendee == 0){
    $EmptySeats = 0;
    $WastedMoney = 0; 
    echo 'EmptySeats:' . $EmptySeats . '<br>';
    echo 'WastedMoney:' . $WastedMoney . '<br>';
  }
  else{
    $EmptySeats = $VenueCapacity - $RemainAttendee;
    $WastedMoney = $CostperPerson * $EmptySeats;
    echo 'EmptySeats:' . $EmptySeats . '<br>';
    echo 'WastedMoney:' . $WastedMoney . '<br>';
  }
  
  $CostperPerson
  

  


?>