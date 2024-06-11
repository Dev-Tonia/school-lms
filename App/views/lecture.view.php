<section class=" mt-3">
    <div class="row row-cols-1 row-cols-md-2 g-3">
        <a href="/" class=" text-decoration-none card-wrapper d-block">
            <div class=" card d-flex shadow justify-content-center align-items-center text-center">
                <div>
                    <div class=" text-primary-subtle fw-bold mt-2 fs-5"> <?= count($assignmentsFormEachLectures) ?></div>
                    <p class="mt-2">Total Assignment</p>
                </div>
            </div>
        </a>
        <a href="/" class=" text-decoration-none card-wrapper d-block">
            <div class=" card d-flex shadow justify-content-center align-items-center text-center">
                <div>
                    <div class=" text-primary-subtle fw-bold mt-2 fs-5"><?= count($submissions) ?></div>
                    <p class="mt-2">submitted Ass</p>
                </div>
            </div>
        </a>

    </div>
</section>
<section class=" px-2 py-2 shadow my-5 rounded bg-success bg-opacity-10">
    <h6 class=" ">Recent Submission</h6>


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