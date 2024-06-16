<?php
loadPartial('layout');
$assignments =  $_SESSION['user']['userType'] ===  'Lecturer' ? $assignments : $assignmentsForEachLevel
?>
<div class="">
  <div class=" d-flex justify-content-between align-items-center ">
    <h5 class=" fw-bold "> All Assignment</h5>
    <?php if ($_SESSION['user']['userType'] ===  'Lecturer') : ?>
      <div class="border border-warning border-2 rounded d-inline-block py-1 px-3">
        <a class=" d-flex  align-items-center text-success fw-bold text-decoration-none" href="/assignments/create">
          <div class="pe-2">
            <i class="bi bi-pen-fill fs-6"></i>
          </div>
          <span class=" "> New Assignment </span>
        </a>
      </div>
    <?php endif; ?>
  </div>
</div>

<section class=" px-2 py-2 shadow my-5 table-responsive rounded bg-success bg-opacity-10">
  <table class="table table-light">
    <thead>
      <tr>
        <th style="white-space: nowrap;" scope="col">Course</th>
        <th style="white-space: nowrap;" scope="col">Assignment Title</th>
        <th style="white-space: nowrap;" scope="col">Description</th>
        <th style="white-space: nowrap;" scope="col">Obtainable Mark</th>
        <th style="white-space: nowrap;" scope="col">Time Frame</th>
        <th style="white-space: nowrap;" scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($assignments as $assignment) : ?>
        <tr>
          <td style="white-space: nowrap;"> <?= $assignment->course ?></td>
          <td style="white-space: nowrap;"> <?= $assignment->title ?> </td>
          <td style="white-space: nowrap; min-width:300px;"> <?= $assignment->question ?> </td>
          <td style="white-space: nowrap;"> <?= $assignment->mark_obtainable ?> </td>
          <td style="white-space: nowrap;"> <?= $assignment->due_date ?> </td>
          <td style="white-space: nowrap;"><a href="/assignments/detail?id=<?= $assignment->id ?>">View</a> </td>

        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</section>


<?php
loadPartial('layout-footer');
loadPartial('footer');
?>