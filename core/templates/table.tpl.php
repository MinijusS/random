<table>
    <thead>
    <?php foreach ($data['thead'] ?? [] as $index => $thead_value) : ?>
        <th><?php print $thead_value; ?></th>
    <?php endforeach; ?>
    </thead>
    <tbody>
    <?php foreach ($data['tbody'] ?? [] as $trow): ?>
        <tr>
            <?php foreach ($trow ?? [] as $tcol_value): ?>
                <td><?php print  $tcol_value; ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
    <tfoot>
    <?php foreach ($data['tfoot'] ?? [] as $tfoot_value): ?>
        <th><?php print $tfoot_value; ?></th>
    <?php endforeach; ?>
    </tfoot>
</table>