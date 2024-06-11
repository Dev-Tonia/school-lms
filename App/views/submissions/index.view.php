<?php

loadPartial('head');
loadPartial('navbar');
loadPartial('sidebar');
?>

<main class="d-flex mt-5 px-3 px-md-5">
    <div class=" col-2">
    </div>
    <div class="col-12 col-md-10 mx-auto">
        <div class="">
            <div class=" d-flex justify-content-between align-items-center ">
                <h5 class=" fw-bold "> All Submission</h5>
            </div>
        </div>

        <section class=" px-2 py-2 shadow my-5 rounded bg-success bg-opacity-10">
            <h6 class=" ">All Submission</h6>

            <table class="table table-light">
                <thead>
                    <tr>
                        <th scope="col">Course</th>
                        <th scope="col">Assignment Title</th>
                        <th scope="col">Level</th>
                        <th scope="col">Name Of Student</th>
                        <th scope="col">Submitted At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($submissions as $submission) : ?>
                        <tr>
                            <td style="min-width:150px;"> <?= $submission->course ?></td>
                            <td> <?= $submission->title ?> </td>
                            <td> <?= $submission->class ?> </td>
                            <td> <?= $submission->first_name ?> <?= $submission->last_name ?></td>
                            <td> <?= $submission->created_at ?></td>
                            <td><a href="/submissions/detail?id=<?= $submission->id ?>">View</a> </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>

</main>

<?php
loadPartial('footer');
?>