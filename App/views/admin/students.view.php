<?php
loadPartial('layout');


?>

<div class="rounded shadow bg-white p-2">
    <div class="d-flex justify-content-between align-items-center">
        <a class="block p-2 text-primary" href="/">
            <i class="bi bi-arrow-left-circle"></i>
            Back To Home
        </a>

    </div>
</div>


<section class=" px-2 py-2 shadow my-5 table-responsive rounded bg-success bg-opacity-10">
    <div class="row pb-4">
        <form class="container-fluid col-6 py-3" method="get" action="/admin/students/search">
            <div class="input-group ">
                <input type="text" class="form-control" placeholder="Search...." name="search" aria-label="search" aria-describedby="basic-addon1" required />
                <button type="submit" class="input-group-text " id="basic-addon1">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
        <!-- <div class="col-4"></div> -->

    </div>

    <table class="table table-light">
        <thead>
            <tr>
                <th style="white-space: nowrap;" scope="col">Index</th>
                <th style="white-space: nowrap;" scope="col">First Name</th>
                <th style="white-space: nowrap;" scope="col">Last Name</th>
                <th style="white-space: nowrap;" scope="col">Email</th>
                <th style="white-space: nowrap;" scope="col">Reg no</th>
                <th style="white-space: nowrap;" scope="col">level </th>
                <th style="white-space: nowrap;" scope="col">Joined at</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $index => $student) : ?>
                <tr>
                    <td style="white-space: nowrap;"> <?= $index + 1 ?></td>
                    <td style="white-space: nowrap;"> <?= $student->first_name ?> </td>
                    <td style="white-space: nowrap;"> <?= $student->last_name ?> </td>
                    <td style="white-space: nowrap;"> <?= $student->email ?> </td>
                    <td style="white-space: nowrap;"> <?= $student->reg_no ?> </td>
                    <td style="white-space: nowrap;"> <?= $student->class_name ?> </td>
                    <td style="white-space: nowrap;"><?= $student->created_at ?>"</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php if ($totalPage > 1) : ?>

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item <?= $page === 1 ? 'disabled' : ''; ?>">
                    <a class="page-link" href="/admin/students?page=<?= $prev ?>" <?= $page === 1 ? 'aria-disabled="true" tabindex="-1"' : ''; ?>>Previous</a>
                </li>
                <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
                    <li class="page-item"><a class="page-link" href="/admin/students?page=<?= $i ?>"><?= $i ?></a></li>
                <?php endfor; ?>
                <li class="page-item <?= $totalPage === $next ? 'disabled' : ''; ?>">
                    <a class="page-link" href="/admin/students?page=<?= $next ?>" <?= $totalPage == $next ? 'aria-disabled="true" tabindex="-1"' : ''; ?>>Next</a>
                </li>

            </ul>
        </nav>
    <?php endif; ?>
</section>

<?php
loadPartial('layout-footer');
loadPartial('footer');
?>