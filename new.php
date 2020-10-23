<?php 

// echo readfile("ProductList.xlsx");
// die;

include('SimpleXLS.php');
$out_file = 'NewProductList.csv';

if ( $xls = SimpleXLSX::parse('ProductList.xlsx') ) {
    // print_r(  );
    $rows = $xls->rows();
    $fw = fopen($out_file, "w");
    
    foreach ($rows as $key => $data) {
        $line = implode(",", $data) . "/n";

        fwrite($fw, $line);

    }

  // fclose($fr);
    fclose($fw);

} else {
    echo SimpleXLS::parseError();
}
die;

$in_file = 'ProductList.xlsx';
$out_file = 'NewProductList.csv';
// function excel_csv_to_csv($in_file, $out_file) {
    if( !$fr = @fopen($in_file, "r") ) die("Failed to open file");
    $fw = fopen($out_file, "w");
    $data = fgetcsv($fr);
    print_r($data);
    die;
    while( ($data = fgetcsv($fr, 1000, ",")) !== FALSE ) {
        foreach( array_keys($data) as $key )
            $data[$key] = '"' . str_replace('"', '""', $data[$key]) . '"';
        $line = implode(",", $data) . "n";
        fwrite($fw, $line);
    }
    fclose($fr);
    fclose($fw);
// }
