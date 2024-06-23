<?php
$assignments = getGradesForAssignments(assignments: $assignmentsForEachLevel, submissions: $studentSubmissions);
//  getGradesForAssignments($studentSubmissions, $assignmentsForEachLevel);
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
$totalScore = getTotal($studentSubmissions, 'grade');

$totalGrade = getTotal($assignmentsForEachLevel, "mark_obtainable");

// to display each value depending on the status of the grade


?>
<section class=" mt-3">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
        <a href="/" class=" text-decoration-none card-wrapper d-block">
            <div class=" card d-flex shadow justify-content-center align-items-center text-center">
                <div>
                    <div class=" text-primary-subtle fw-bold mt-2 fs-5"> <?= $totalScore ?> /
                        <?= $totalGrade ?></div>
                    <p class="mt-2">Score</p>
                </div>
            </div>
        </a>
        <a href="/" class=" text-decoration-none card-wrapper d-block">
            <div class=" card d-flex shadow justify-content-center align-items-center text-center">
                <div>
                    <div class=" text-primary-subtle fw-bold mt-2 fs-5"> <?= count($assignmentsForEachLevel) ?></div>
                    <p class="mt-2">Total Assignment</p>
                </div>
            </div>
        </a>
        <a href="/" class=" text-decoration-none card-wrapper d-block">
            <div class=" card d-flex shadow justify-content-center align-items-center text-center">
                <div>
                    <div class=" text-primary-subtle fw-bold mt-2 fs-5"><?= count($studentSubmissions) ?></div>
                    <p class="mt-2">submitted Ass</p>
                </div>
            </div>
        </a>

    </div>
</section>
<section class=" px-2 py-2 shadow my-5 table-responsive rounded bg-success bg-opacity-10">
    <h6>Recent Assignments</h6>
    <?php loadPartial('student-table', [
        'assignments' => $assignments
    ]) ?>
</section>