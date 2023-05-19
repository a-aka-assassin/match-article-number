   //This mathces the article number which are present in the first file with article numbers in second file
        ini_set('max_execution_time', '300');
        $csv = array_map("str_getcsv", file("uploads/reitanColored.csv", FILE_SKIP_EMPTY_LINES));
        $keys = array_shift($csv);

        $csv2 = array_map("str_getcsv", file("uploads/ms.csv", FILE_SKIP_EMPTY_LINES));

        $keys2 = array_shift($csv2);

        foreach ($csv2 as $i => $row) {
            $csv2[$i] = array_combine($keys2, $row);
        }

        foreach ($csv as $i => $row) {
            $csv[$i] = array_combine($keys, $row);
        }

        $count = 0;
        foreach ($csv as $value) {

            foreach ($csv2 as &$value2) {
                if ($value['gtin'] == $value2['GTIN']) {
                    $value2['Done'] = "Yes";
                    $count++;
                }
            }
        }
        echo "Finished with " . $count;

        echo "Finished with " . $count;
        $file = 'C:\Users\arsalan\Desktop\\msMarked.csv';
        $fp = fopen($file, 'w');

        // Loop through file pointer and a line
        foreach ($csv2 as $fields) {
            fputcsv($fp, $fields);
        }

        fclose($fp);