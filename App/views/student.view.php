<?php

// Function to get grades for each assignment
function getGradesForAssignments($submissions, $assignments)
{
    $results = [];
    foreach ($assignments as $assignment) {
        // Initialize grade as NULL (or any default value)
        $grade = '';

        foreach ($submissions as $submission) {

            if ($submission->assignment_id === $assignment->id) {
                $grade = $submission->grade;  // Get the actual grade if found
                break;
            }
        }
        $results[] = [
            'course' => $assignment->course,
            'title' => $assignment->title,
            'question' => $assignment->question,
            'due_date' => $assignment->due_date,
            'grade' => $grade,
            'id' => $assignment->id
        ];
    }
    return $results;
}
$assignments = getGradesForAssignments($studentSubmissions, $assignmentsForEachLevel);

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
                    <div class=" text-primary-subtle fw-bold mt-2 fs-5"> <?= $total['totalScore'] ?> /
                        <?= $total['totalGrade'] ?></div>
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
<section class=" px-2 py-2 shadow my-5 rounded bg-success bg-opacity-10">
    <h6>Recent Assignments</h6>
    <table class="table table-light">
        <thead>
            <tr>
                <th scope="col">Course</th>
                <th scope="col">Assignment Title</th>
                <th scope="col">Description</th>
                <th scope="col">Status</th>
                <th scope="col">Due Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assignments as $assignment) : ?>
                <tr>
                    <td style="min-width:150px;"> <?= $assignment['course'] ?></td>
                    <td> <?= $assignment['title'] ?> </td>
                    <td> <?= $assignment['question'] ?> </td>
                    <td> <?= getGradeStatus($assignment['grade']) ?> </td>
                    <td> <?= $assignment['due_date'] ?> </td>
                    <td><a href="/assignments/detail?id=<?= $assignment['id'] ?>">View</a> </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>