<?php
require_once 'paginator.php';
require_once 'config.php';

$conn       = new mysqli( $dbhost, $dbuser, $dbpass, $dbname );
$conn->set_charset('utf8mb4');
$limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 25;
$page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
$links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 7;
$query      = "SELECT * FROM pos_ner where pos1!='' or pos2!='' or pos3!=''";
$Paginator  = new Paginator( $conn, $query );
$results    = $Paginator->getData( $limit, $page );
?>
<table class="table table-striped table-condensed table-bordered table-rounded">
    <thead class="text-primary bg-dark text-center">
        <tr>
          <th>#</th>
            <th>Line</th>
            <th width="20%">Word</th>
            <th width="20%">POS1 && NER1</th>
            <th width="25%">POS2 && NER2</th>
            <th width="25%">POS3 && NER3</th>
            <th width="25%">Final POS</th>
            <th width="25%">Final NER</th>
        </tr>
    </thead>
    <tbody class="text-center">
    <?php for( $i = 0; $i < count( $results->data ); $i++ ) : ?>
        <tr>
           <td><?php echo $i+1; ?></td>
                <td><?php echo $results->data[$i]['line_no']; ?></td>
                <td><?php echo $results->data[$i]['word']; ?></td>
                <td><?php echo $results->data[$i]['pos1']."-".$results->data[$i]['ner1']; ?></td>
                <td><?php echo $results->data[$i]['pos2']."-".$results->data[$i]['ner2']; ?></td>
                <td><?php echo $results->data[$i]['pos3']."-".$results->data[$i]['ner3']; ?></td>
                <td><?php echo $results->data[$i]['fpos']?></td>
                <td><?php echo $results->data[$i]['fner']?></td>
        </tr>
    <?php endfor; ?>
    </tbody>
</table>
<?php //echo $Paginator->createLinks( $links, 'pagination pagination-sm' ); ?>
