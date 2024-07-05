<?php
loadPartial('layout');
$user =  $_SESSION['user']['userType'];
// $assignments = $user === 'Lecturer' ? $assignmentsForEachLecture : ($user === 'Student' ? $assignmentsForEachStudent : $assignments);
$assignments = [];

if ($user === 'Lecturer') {
  $assignments = $assignmentsForEachLecture;
} else {
  $assignments = $allAssignments; // Optional: Handle unexpected user types
}


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
  <div class="row pb-4">
    <form class="container-fluid col-6 py-3" method="get" action="/assignment/search">
      <div class="input-group ">
        <input type="text" class="form-control" placeholder="Search...." name="search" aria-label="search" aria-describedby="basic-addon1" required />
        <button type="submit" class="input-group-text " id="basic-addon1">
          <i class="bi bi-search"></i>
        </button>
      </div>
    </form>
    <!-- <div class="col-4"></div> -->

  </div>
  <?php if ($user === 'Student') : ?>
    <?php
    loadPartial('student-table', [
      'prev' => $prev,
      'next' => $next,
      'page' => $page,
      'totalPage' => $totalPage,
      'assignments' => $assignmentsForEachStudent
    ])
    ?>
  <?php else : ?>
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
            <td style="white-space: nowrap;"> <?= $assignment->course_code ?></td>
            <td style="white-space: nowrap;"> <?= $assignment->title ?> </td>
            <td style="white-space: nowrap; min-width:300px;"> <?= $assignment->question ?> </td>
            <td style="white-space: nowrap;"> <?= $assignment->mark_obtainable ?> </td>
            <td style="white-space: nowrap;"> <?= $assignment->due_date ?> </td>
            <td style="white-space: nowrap;"><a href="/assignments/detail?id=<?= $assignment->id ?>">View</a> </td>

          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

  <?php endif ?>
  <?php if ($totalPage > 1) : ?>

    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li class="page-item <?= $page === 1 ? 'disabled' : ''; ?>">
          <a class="page-link" href="/assignments?page=<?= $prev ?>" <?= $page === 1 ? 'aria-disabled="true" tabindex="-1"' : ''; ?>>Previous</a>
        </li>
        <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
          <li class="page-item"><a class="page-link" href="/assignments?page=<?= $i ?>"><?= $i ?></a></li>
        <?php endfor; ?>
        <li class="page-item <?= $totalPage === $next ? 'disabled' : ''; ?>">
          <a class="page-link" href="/assignments?page=<?= $next ?>" <?= $totalPage == $next ? 'aria-disabled="true" tabindex="-1"' : ''; ?>>Next</a>
        </li>

      </ul>
    </nav>
  <?php endif; ?>

</section>

<?php
loadPartial('layout-footer');
loadPartial('footer');
?>