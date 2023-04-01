// Test 2
$filename = 'data-xample  .csv';

// Read in the CSV data
if (($handle = fopen($filename, 'r')) !== false) {
    $header = fgetcsv($handle);
    $data = array();
    while (($row = fgetcsv($handle)) !== false) {
        $data[] = array_combine($header, $row);
    }
    fclose($handle);
}

// Define the sorting function
function sortByLastName($a, $b) {
    return strcmp($a['Last Name'], $b['Last Name']);
}

// Sort the data
usort($data, 'sortByLastName');

// Write the sorted data to a new CSV file
if (($handle = fopen('sorted_data_1.csv', 'w')) !== false) {
    fputcsv($handle, $header);
    foreach ($data as $row) {
        fputcsv($handle, $row);
    }
    fclose($handle);
}
