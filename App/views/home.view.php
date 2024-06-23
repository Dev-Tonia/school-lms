<?php
$user = $_SESSION['user'];
$userRole = $user['userType'];

function getRole($userType)
{
  global $user;
  if ($userType === 'Student') {
    return $user['reg-no'];
  } else {
    return  $user['userType'];
  }
}

?>

<?php loadPartial('layout') ?>

<div class="grid  gap-5 w-full">
  <div class="col-5 col-md-3">
    <h5 class=""> Welcome back, <?= $_SESSION['user']['firstName'] ?></h5>
    <h5 class=" fs-6 text-center px-2 py-1 text-white rounded-pill uppercase bg-success bg-opacity-20 ">
      <?= getRole($userRole) ?> </h5>
  </div>
</div>
<?php

if ($userRole ===  'Lecturer') {
  loadPartial('lecture-home', [
    'submissions' => $submissions,
    'assignmentsFormEachLectures' => $assignmentsFormEachLectures
  ]);
} else if ($userRole === 'Student') {
  loadPartial('student-home', [
    'assignmentsForEachLevel' => $assignmentsForEachLevel,
    'studentSubmissions' => $studentSubmissions
  ]);
} else {
  loadPartial('admin-home', [
    'submissions' => $submissions,
    'allStudent' => $allStudent,
    'allAssignment' => $allAssignment
  ]);
}


?>

<?php
loadPartial('layout-footer');
loadPartial('footer');
?>