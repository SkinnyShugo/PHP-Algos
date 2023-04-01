// Method 3
$filename = 'data.csv';

// Read in the CSV data
$file = new SplFileObject($filename, 'r');
$file->setFlags(SplFileObject::READ_CSV);
$header = $file->fgetcsv();
$data = array();
foreach ($file as $row) {
    if ($row !== false) {
        $data[] = array_combine($header, $row);
    }
}

// Sort the data
usort($data, function($a, $b) {
    return strcmp($a['Last Name'], $b['Last Name']);
});

// Write the sorted data to a new CSV file
$file = new SplFileObject('sorted_data_3.csv', 'w');
$file->fputcsv($header);
foreach ($data as $row) {
    $file->fputcsv($row);
}
