<?php
   $NumberofStudents = $_POST['NumberofStudents'];
   $SlicesperStudent = $_POST['SlicesperStudent'];
   $SlicesperPizza = $_POST['SlicesperPizza'];

   $RequiredSlices = $SlicesperStudent * $NumberofStudents;

   $TotalPizzas = ceil($RequiredSlices / $SlicesperPizza);

   echo 'Total Pizzas:' . $TotalPizzas . '<br>';

   $TotalSlices = $TotalPizzas * $SlicesperPizza;

   $LeftOverSlices = $TotalSlices - $RequiredSlices;

   if($LeftOverSlices == 0){
      echo 'Leftover Slices: ' . $LeftOverSlices . '<br>';
      $WastedMoney = 0;
      echo 'Wasted Money:' . $WastedMoney;
   }
   else{
     echo 'Leftover Slices: ' . $LeftOverSlices . '<br>';

     $priceofeachpizza = 1050;

     $WastedMoney = ($priceofeachpizza * $LeftOverSlices) / $SlicesperPizza;

     echo 'Wasted Money:' . $WastedMoney;

   }





?>