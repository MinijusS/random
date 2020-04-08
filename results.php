<?php
include 'bootloader.php';
$data = file_to_array(DB_FILE) ?: [];
$results = [];
$total = count($data);

foreach ($data as $response) {
    foreach ($response as $question_id => $answer) {
        if (!isset($results[$question_id])) {
            $results[$question_id] = 0;
        }
        if ($answer == 'yes') {
            $results[$question_id]++;
        }
    }
}

foreach ($results as $index => $result) {
    $result = round(($result / $total) * 100, 1);
    $results[$index] = $result;
}

$questions = [
    'question1' => 'Ar laikai kardana?',
    'question2' => 'Ar pili i baka?',
    'question3' => 'Ar rukai zoliu arbata?'
];

$table = [
    'thead' => [
        'Klausimas',
        'Taip (%)'
    ],
    'tbody' => [],
    'tfoot' => []
];

$body = [];

foreach ($results as $index => $result) {
    $body[$index] = [$questions[$index], $result];
    $table['tbody'][] = $body[$index];
}

$h1 = "Viso respondentu: {$total}";
?>
<html>
<head>
    <title>Useriai</title>
    <link href="/app/assets/styles.css" rel="stylesheet">
</head>
<body>
<?php include 'core/templates/table.tpl.php'; ?>
<h1><?php print $h1; ?></h1>
</body>
</html>