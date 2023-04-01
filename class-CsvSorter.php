class CsvSorter {
    private $data = array();
    private $header = array();
    private $sortColumns = array();

    public function __construct($filename) {
        $handle = fopen($filename, "r");
        while (($row = fgetcsv($handle, 1000, ",")) !== false) {
            $this->data[] = $row;
        }
        fclose($handle);
        $this->header = array_shift($this->data);
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function setHeader($header) {
        $this->header = $header;
    }

    public function setSortColumns($sortColumns) {
        $this->sortColumns = $sortColumns;
    }

    public function sort() {
        $data = array_map(function($row) {
            return array_combine($this->header, $row);
        }, $this->data);

        usort($data, function($a, $b) {
            foreach ($this->sortColumns as $sortColumn) {
                $result = strcasecmp($a[$sortColumn], $b[$sortColumn]);
                if ($result != 0) {
                    return $result;
                }
            }
            return 0;
        });

        return $data;
    }

    public function writeToFile($filename) {
        $handle = fopen($filename, "w");
        fputcsv($handle, $this->header);
        foreach ($this->data as $row) {
            fputcsv($handle, $row);
        }
        fclose($handle);
    }
}

// Example usage:
$sorter = new CsvSorter("data.csv");
$sorter->setSortColumns(array("Last Name", "First Name"));
$sortedData = $sorter->sort();
$sorter->setData($sortedData);
$sorter->writeToFile("sorted_data.csv");
