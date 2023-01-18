<?php
require_once 'paginator.php';

$conn       = new mysqli( 'localhost', 'root', '', 'bpnd' );
$conn->set_charset('utf8mb4');
$limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 25;
$page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
$links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 7;
$query      = "SELECT * FROM pos_ner where pos1!='' or pos2!='' or pos3!=''";
$Paginator  = new Paginator( $conn, $query );
$results    = $Paginator->getData( $limit, $page );
?>
<table class="table table-striped table-condensed table-bordered table-rounded">
    <thead>
        <tr>
            <th>Line</th>
            <th width="20%">Word</th>
            <th width="20%">POS1 && NER1</th>
            <th width="25%">POS2 && NER2</th>
            <th width="25%">POS3 && NER3</th>
        </tr>
    </thead>
    <tbody>
    <?php for( $i = 0; $i < count( $results->data ); $i++ ) : ?>
        <tr>
                <td><?php echo $results->data[$i]['line_no']; ?></td>
                <td><?php echo $results->data[$i]['word']; ?></td>
                <td><?php echo $results->data[$i]['pos1']."-".$results->data[$i]['ner1']; ?></td>
                <td><?php echo $results->data[$i]['pos2']."-".$results->data[$i]['ner2']; ?></td>
                <td><?php echo $results->data[$i]['pos3']."-".$results->data[$i]['ner3']; ?></td>
        </tr>
    <?php endfor; ?>
    </tbody>
</table>
<?php //echo $Paginator->createLinks( $links, 'pagination pagination-sm' ); ?>
