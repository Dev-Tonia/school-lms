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
                <td style="white-space: nowrap;"> <?php echo getGradeStatus($assignment['grade']) //the function is the helper file 
                                                    ?> </td>
                <td style="white-space: nowrap;"> <?= $assignment['due_date'] ?> </td>
                <td style="white-space: nowrap;"><a href="/assignments/detail?id=<?= $assignment['id'] ?>">View</a> </td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>