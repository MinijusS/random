<?php
include 'bootloader.php';
$data = file_to_array(DB_FILE);
if($data){
    foreach ($data as $index => $item) {
        unset($item['password_repeat']);
        $data[$index] = $item;
    }
} else {
    $data = [];
}

$table = [
    'thead' => [
        'Username',
        'Password'
    ],
    'tbody' => []
];

$table['tbody'] = $data;

?>
<html>
<head>
    <title>Useriai</title>
    <link href="/app/assets/styles.css" rel="stylesheet">
</head>
<body>
<?php include 'core/templates/table.tpl.php'; ?>
</body>
</html>