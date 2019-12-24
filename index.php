<?php
include_once 'config/Database.php';

$db = new Database();
$table = '';
if (!isset($_GET['table'])) {
    $sql = 'SHOW TABLES';
    $all_tables_que = $db->myQuery($sql);

    $all_tables = array();

    foreach ($all_tables_que as $key => $val) {
        foreach ($val as $key2 => $val2) {
            $all_tables[] = $val2;
        }
    }

    //echo '<pre>';
    //print_r($all_tables);
    //echo '</pre>';
    //die;


} else {
    $table_thead = array();
    $table = $_GET['table'];
    $sql = 'SELECT * FROM ' . $table;
    $table_data = $db->myQuery($sql);
    $table_thead = $table_data[0];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, td, th {
            border: 1px solid black;
        }
    </style>
</head>
<body>

<?php if (!isset($_GET['table'])) { ?>
    <div>
        <h1>All Tables</h1>
        <ol>
            <?php foreach ($all_tables as $one_table) {
                $sql = 'SELECT COUNT(1) as count_data FROM ' . $one_table;
                $count_data = $db->myQuery($sql);
                ?>
                <li><a href="?table=<?php echo $one_table; ?>">
                        <?php echo $one_table; ?> - (<?php echo $count_data[0]['count_data']; ?>)
                    </a>
                </li>
            <?php } ?>
        </ol>

    </div>
<?php } else { ?>
    <div>
        <p><a href="/">Back</a></p>
        <h1>Table - <?php echo $table; ?></h1>
        <table>
            <thead>
            <tr>
                <?php foreach ($table_thead as $key => $val) { ?>
                    <th><?php echo $key; ?></th>
                <?php } ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($table_data as $data) {
                $values = array_values($data);
                ?>
                <tr>
                    <?php foreach ($values as $val) { ?>
                        <td><?php echo $val; ?></td>
                    <?php } ?>
                </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>
<?php } ?>

</body>
</html>






