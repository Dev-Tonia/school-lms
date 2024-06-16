<?php
loadPartial('layout');
$assignments =  $_SESSION['user']['userType'] ===  'Lecturer' ? $assignments : $assignmentsForEachLevel
?>

<main class="d-flex mt-5 px-3 px-md-5">
  <div class=" col-2">
  </div>
  <div class="col-12 col-md-10 mx-auto">
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

    <section class=" px-2 py-2 shadow my-5 rounded bg-success bg-opacity-10">
      <table class="table table-light">
        <thead>
          <tr>
            <th scope="col">Course</th>
            <th scope="col">Assignment Title</th>
            <th scope="col">Description</th>
            <th scope="col">Obtainable Mark</th>
            <th scope="col">Time Frame</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($assignments as $assignment) : ?>
            <tr>
              <td style="min-width:150px;"> <?= $assignment->course ?></td>
              <td> <?= $assignment->title ?> </td>
              <td> <?= $assignment->question ?> </td>
              <td> <?= $assignment->mark_obtainable ?> </td>
              <td> <?= $assignment->due_date ?> </td>
              <td><a href="/assignments/detail?id=<?= $assignment->id ?>">View</a> </td>

            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </section>
  </div>

</main>

<?php
loadPartial('layout-footer');
loadPartial('footer');
?>