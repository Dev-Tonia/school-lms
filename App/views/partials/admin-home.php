<section class=" mt-3">
    <div class="row row-cols-1 row-cols-md-3 g-3">
        <a href="/" class=" text-decoration-none card-wrapper d-block">
            <div class=" card d-flex shadow justify-content-center align-items-center text-center">
                <div>
                    <div class=" text-primary-subtle fw-bold mt-2 fs-5"> <?= count($allStudent) ?></div>
                    <p class="mt-2">Students Count</p>
                </div>
            </div>
        </a>
        <a href="/" class=" text-decoration-none card-wrapper d-block">
            <div class=" card d-flex shadow justify-content-center align-items-center text-center">
                <div>
                    <div class=" text-primary-subtle fw-bold mt-2 fs-5"> <?= count($allAssignment) ?></div>
                    <p class="mt-2">Total Assignment</p>
                </div>
            </div>
        </a>
        <a href="/" class=" text-decoration-none card-wrapper d-block">
            <div class=" card d-flex shadow justify-content-center align-items-center text-center">
                <div>
                    <div class=" text-primary-subtle fw-bold mt-2 fs-5"><?= count($submissions) ?></div>
                    <p class="mt-2">submissions </p>
                </div>
            </div>
        </a>

    </div>
</section>
<section class=" px-2 py-2 shadow my-5 rounded bg-success table-responsive bg-opacity-10">
    <h6 class=" ">Recent Submission</h6>
    <table class="table table-light">
        <thead>
            <tr>
                <th style="white-space: nowrap;" scope="col">Course</th>
                <th style="white-space: nowrap;" scope="col">Assignment Title</th>
                <th style="white-space: nowrap;" scope="col">Level</th>
                <th style="white-space: nowrap;" scope="col">Name Of Student</th>
                <th style="white-space: nowrap;" scope="col">Submitted At</th>
                <th style="white-space: nowrap;" scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($submissions as $submission) : ?>
                <tr>
                    <td style="white-space: nowrap;"> <?= $submission->course_code ?></td>
                    <td style="white-space: nowrap;"> <?= $submission->title ?> </td>
                    <td style="white-space: nowrap;"> <?= $submission->class_name ?> </td>
                    <td style="white-space: nowrap;"> <?= $submission->first_name ?> <?= $submission->last_name ?></td>
                    <td style="white-space: nowrap;"> <?= $submission->created_at ?></td>
                    <td style="white-space: nowrap;"><a href="/submissions/detail?id=<?= $submission->id ?>">View</a> </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>