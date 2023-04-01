// Method 2
$filename = 'data-xample.csv';

// Read in the CSV data
$rows = file($filename, FILE_IGNORE_NEW_LINES);
$header = str_getcsv(array_shift($rows));
$data = array();
foreach ($rows as $row) {
    $data[] = array_combine($header, str_getcsv($row));
}

// Sort the data
usort($data, function($a, $b) {
    return strcmp($a['Last Name'], $b['Last Name']);
});

// Write the sorted data to a new CSV file
file_put_contents('sorted_data_2.csv', implode(PHP_EOL, array_map('csv_format', array_merge(array($header), $data))));
