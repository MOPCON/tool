<?php
/**
 * $ php conver_list.php
 */

require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$path = '../storage/email/';
$output_list = $path . 'output.csv';
$url_format = 'https://mopcon.page.link/?apn=org.mopcon.session.app&isi=721411970&ibi=org.mopcon.session.app&ofl=https://mopcon.org/2019&link=https://mopcon.org/2019/invite?sn=%s';

$fp = fopen($output_list, 'w');
fputcsv($fp, ['EMAIL', 'NAME', 'URL']);

$reader = new Xlsx();
$reader->setReadDataOnly(true);

if (file_exists($path) && is_dir($path)) {
    $scan_arr = scandir($path);
    foreach ($scan_arr as $file_name) {
        if (strpos($file_name, '.xlsx') !== false) {
            $full_file_path = $path . $file_name;
            $spreadsheet = $reader->load($full_file_path);
            $lists = $spreadsheet->getActiveSheet()->toArray();

            foreach ($lists as $data) {
                if (is_numeric($data[0]) && $data[5] == 'paid') {
                    $email = $data[11];
                    $name = $data[10];
                    $url = sprintf($url_format, $data[7]);
                    fputcsv($fp, [$email, $name, $url]);
                }
            }
        }
    }
}

fclose($fp);
