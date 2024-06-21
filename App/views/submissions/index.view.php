<?php loadPartial('layout') ?>

<div class="">
    <div class=" d-flex justify-content-between align-items-center ">
        <h5 class=" fw-bold "> All Submission</h5>
    </div>
    <?php
    if (isset($_SESSION['error'])) : ?>
        <div class=" bg-danger px-4 py-2 text-white">
            <?php
            echo $_SESSION['error']['errorMessage'];
            unset($_SESSION['error']);
            ?>
        </div>
    <?php endif; ?>
</div>

<section class=" px-2 py-2 shadow my-5 rounded table-responsive bg-success bg-opacity-10">

    <h6 class=" ">All Submission</h6>

    <table class="table table-light">
        <thead>
            <tr>
                <th style="white-space: nowrap;" scope="col">Course</th>
                <th style="white-space: nowrap;" scope="col">Assignment Title</th>
                <th style="white-space: nowrap;" scope="col">Level</th>
                <th style="white-space: nowrap;" scope="col">Name Of Student</th>
                <th style="white-space: nowrap;" scope="col">Grade</th>
                <th style="white-space: nowrap;" scope="col">Submitted At</th>
                <th style="white-space: nowrap;" scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($submissions as $submission) : ?>
                <tr>
                    <td style="white-space: nowrap;"> <?= $submission->course ?></td>
                    <td style="white-space: nowrap;"> <?= $submission->title ?> </td>
                    <td style="white-space: nowrap;"> <?= $submission->class ?> </td>
                    <td style="white-space: nowrap;"> <?= $submission->first_name ?> <?= $submission->last_name ?></td>
                    <td style="white-space: nowrap;"> <?= $submission->grade ?? 'Not graded' ?></td>
                    <td style="white-space: nowrap;"> <?= $submission->created_at ?></td>
                    <td style="white-space: nowrap;"><a href="/submissions/detail?id=<?= $submission->id ?>">View</a> </td>
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