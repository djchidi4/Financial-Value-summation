<?php
function categorizeAndSummarizeCSV($csvFilePath) {
    $categories = [];

    if (($handle = fopen($csvFilePath, "r")) !== FALSE) {
        fgetcsv($handle, 1000, ",");

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $industry = $data[3];
            $financialValue = floatval($data[8]);

            if (!isset($categories[$industry])) {
                $categories[$industry] = $financialValue;
            } else {
                $categories[$industry] += $financialValue;
            }
        }
        fclose($handle);
    }

    echo "<table border='1'>
            <tr>
                <th>Industry</th>
                <th>Financial Value Summation</th>
            </tr>";

    foreach ($categories as $industry => $value) {
        echo "<tr>
                <td>{$industry}</td>
                <td>{$value}</td>
            </tr>";
    }

    echo "</table>";
}

categorizeAndSummarizeCSV('summation.csv');

?>
