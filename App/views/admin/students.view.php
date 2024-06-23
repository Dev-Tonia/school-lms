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
</section>

<?php
loadPartial('layout-footer');
loadPartial('footer');
?>