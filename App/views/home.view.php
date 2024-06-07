<?php
loadPartial('head');
loadPartial('navbar');
loadPartial('sidebar');

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

$totalGrade = getTotal($assignmentsForEachLevel, 'grade');



?>

<main class="d-flex mt-5 px-3 px-md-5">
  <div class=" col-2">
  </div>

  <div class="col-12 col-md-10 mx-auto">
    <div class="grid  gap-5 w-full">
      <div class=" col-3">
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


  </div>

</main>

<?php
loadPartial('footer');
?>