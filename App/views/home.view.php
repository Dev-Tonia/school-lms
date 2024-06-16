<?php


/**
 * get the total value 
 *
 * @param array $array
 * @param string $value
 * @return number
 */
function getTotal($array, $value)
{
  $total = 0;
  foreach ($array as $list) {
    $total += (float)  $list->$value;
  }
  return $total;
}


$totalScore = getTotal($scores, 'score');

$totalGrade = getTotal($assignmentsForEachLevel, 'mark_obtainable');



?>

<?php loadPartial('layout') ?>

<div class="grid  gap-5 w-full">
  <div class="col-5 col-md-3">
    <h5 class=""> Welcome back, <?= $_SESSION['user']['firstName'] ?></h5>
    <h5 class=" fs-6 text-center px-2 py-1 text-white rounded-pill uppercase bg-success bg-opacity-20 ">
      <?= $_SESSION['user']['userType'] ===  'Lecturer' ?  $_SESSION['user']['employee-no']  : $_SESSION['user']['reg-no'] ?> </h5>
  </div>
</div>
<?php

if ($_SESSION['user']['userType'] ===  'Lecturer') {
  loadView('lecture', [
    'submissions' => $submissions,
    'assignmentsFormEachLectures' => $assignmentsFormEachLectures
  ]);
} else {
  loadView('student', [
    'total' => [
      'totalGrade' => $totalGrade,
      'totalScore' => $totalScore
    ],
    'assignmentsForEachLevel' => $assignmentsForEachLevel,
    'studentSubmissions' => $studentSubmissions
  ]);
}


?>

<?php
loadPartial('layout-footer');
loadPartial('footer');
?>