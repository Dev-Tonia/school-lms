<?php

function getRole($user)
{
  if ($user === 'Student') {
    return $_SESSION['user']['reg-no'];
  } else {
    return  $_SESSION['user']['userType'];
  }
}

?>

<?php loadPartial('layout') ?>

<div class="grid  gap-5 w-full">
  <div class="col-5 col-md-3">
    <h5 class=""> Welcome back, <?= $_SESSION['user']['firstName'] ?></h5>
    <h5 class=" fs-6 text-center px-2 py-1 text-white rounded-pill uppercase bg-success bg-opacity-20 ">
      <?= getRole($_SESSION['user']['userType']) ?> </h5>
  </div>
</div>
<?php

if ($_SESSION['user']['userType'] ===  'Lecturer') {
  loadPartial('lecture-home', [
    'submissions' => $submissions,
    'assignmentsFormEachLectures' => $assignmentsFormEachLectures
  ]);
} else {
  loadPartial('student-home', [
    'scores' => $scores,
    'assignmentsForEachLevel' => $assignmentsForEachLevel,
    'studentSubmissions' => $studentSubmissions
  ]);
}


?>

<?php
loadPartial('layout-footer');
loadPartial('footer');
?>