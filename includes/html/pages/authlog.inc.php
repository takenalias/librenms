<?php

echo "<h3>Authlog</h3>";
if (Auth::user()->hasGlobalAdmin()) {
    echo '<table id="authlogtable" class="table table-hover table-condensed">';
    echo "<thead><th data-column-id='timestamp'>Timestamp</th><th data-column-id='user'>User</th><th data-column-id='ip'>IP Address</th><th data-column-id='authres'>Result</th></thead><tbody>";
    foreach (dbFetchRows("SELECT *,DATE_FORMAT(datetime, '" . \LibreNMS\Config::get('dateformat.mysql.compact') . "') as humandate  FROM `authlog` ORDER BY `datetime` DESC LIMIT 0,250") as $entry) {
        if ($bg == \LibreNMS\Config::get('list_colour.even')) {
            $bg = \LibreNMS\Config::get('list_colour.odd');
        } else {
            $bg = \LibreNMS\Config::get('list_colour.even');
        }

        echo "<tr>
            <td>
            ".$entry['datetime'].'
            </td>
            <td>
            '.$entry['user'].'
            </td>
            <td>
            '.$entry['address'].'
            </td>
            <td>
            '.$entry['result'].'
            </td>
            ';
    }//end foreach

    $pagetitle[] = 'Authlog';

    echo '</tbody></table>';
} else {
    include 'includes/html/error-no-perm.inc.php';
}//end if
?>
<script>
    $('#authlogtable').bootgrid({
        rowCount: [50, 100, 250, -1],
        columnSelection: true,
    });
</script>
