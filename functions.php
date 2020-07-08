<?php 

require __DIR__ . '/vendor/autoload.php';

if(isset($_POST['submit'])){

$client = new \Google_Client();
$client->setApplicationName('Google Sheets API PHP Quickstart');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAuthConfig(__DIR__ . '/credentials.json');
$client->setAccessType('offline');

$service = new Google_Service_Sheets($client);
$spreadsheetId = "1BEr9xakYXXheNy9bfC0towrpMEZA2bC2gDuAOPkWzRw";

$range = "climprod";
$values = [
    ["01", $_POST['first_name'], $_POST['address'], $_POST['city'], $_POST['phone']],
];

$body = new Google_Service_Sheets_ValueRange([
    'values' => $values
]);

$params = [
    'valueInputOption' => 'RAW'
];

$insert = [
    "insertDataOption" => "INSERT_ROWS"
];

$result = $service->spreadsheets_values->append(
    $spreadsheetId,
    $range,
    $body,
    $params,
    $insert
);

header('location: index.php?order');

}
// $response = $service->spreadsheets_values->get($spreadsheetId, $range);
// $values = $response->getValues();

// if (empty($values)) {
//     print "No data found.\n";
// } else {
//     $mask = "%10s %-10s %s\n";
//     foreach ($values as $row) {
//         // Print columns A and E, which correspond to indices 0 and 4.
//        echo  sprintf($mask, $row[2], $row[1], $row[0]);
//     }
// }

?>
