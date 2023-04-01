

// Step 1: Read in the CSV data
$handle = fopen("data-xample.csv", "r");
$data = array();
while (($row = fgetcsv($handle, 1000, ",")) !== false) {
    $data[] = $row;
}
fclose($handle);

// Step 2: Store the data in an array
// The example data has a header row, so we'll skip it using array_slice()
$header = array_shift($data);
$data = array_map(function($row) use ($header) {
    return array_combine($header, $row);
}, $data);

// Step 3: Determine which column(s) to sort by
$sortColumns = array("Last Name", "First Name");

// Step 4: Sort the data
usort($data, function($a, $b) use ($sortColumns) {
    foreach ($sortColumns as $sortColumn) {
        $result = strcasecmp($a[$sortColumn], $b[$sortColumn]);
        if ($result != 0) {
            return $result;
        }
    }
    return 0;
});

// Step 5: Write the sorted data to a new CSV file
$handle = fopen("sorted_data.csv", "w");
fputcsv($handle, $header);
foreach ($data as $row) {
    fputcsv($handle, $row);
}
fclose($handle);
