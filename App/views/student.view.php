<?php

// Function to get grades for each assignment
function getGradesForAssignments($submissions, $assignments)
{
    $results = [];
    foreach ($assignments as $assignment) {
        // Initialize grade 
        $grade = '';

        foreach ($submissions as $submission) {

            if ($submission->assignment_id === $assignment->id && $submission->user_id === $_SESSION['user']['id']) {
                $grade = $submission->grade;  // Get the actual grade if found
                break;
            }
        }
        $results[] = [
            'course' => $assignment->course,
            'title' => $assignment->title,
            'question' => $assignment->question,
            'mark_obtainable' => $assignment->mark_obtainable,
            'due_date' => $assignment->due_date,
            'grade' => $grade,
            'id' => $assignment->id
        ];
    }
    return $results;
}
$assignments = getGradesForAssignments($studentSubmissions, $assignmentsForEachLevel);



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

$totalGrade = getTotal($assignmentsForEachLevel, "mark_obtainable");

// to display each value depending on the status of the grade
function getGradeStatus($grade)
{
    if ($grade === null) {
        return 'Not graded';
    } elseif ($grade === '') {
        return 'Not submitted';
    } else {
        return 'Graded: ' . $grade;
    }
}

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
    <table class="table table-light">
        <thead>
            <tr>
                <th style="white-space: nowrap;">
                    Course</th>
                <th style="white-space: nowrap;">
                    Assignment Title</th>
                <th style="white-space: nowrap;">
                    Description</th>
                <th style="white-space: nowrap;">
                    Total Mark</th>
                <th style="white-space: nowrap;">
                    Status</th>
                <th style="white-space: nowrap;">
                    Due Date</th>
                <th style="white-space: nowrap;">
                    Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assignments as $assignment) : ?>
                <tr>
                    <td style="white-space: nowrap;"> <?= $assignment['course'] ?></td>
                    <td style="white-space: nowrap;"> <?= $assignment['title'] ?> </td>
                    <td style="min-width:300px;"> <?= $assignment['question'] ?> </td>
                    <td style="white-space: nowrap;"> <?= $assignment['mark_obtainable'] ?> </td>
                    <td style="white-space: nowrap;"> <?= getGradeStatus($assignment['grade']) ?> </td>
                    <td style="white-space: nowrap;"> <?= $assignment['due_date'] ?> </td>
                    <td style="white-space: nowrap;"><a href="/assignments/detail?id=<?= $assignment['id'] ?>">View</a> </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>