
<?php

use Carbon\Carbon;

$date = Carbon::now();
$date = $date->toDateString();

return [
    'TODAY_DATE' => $date,
    'PANEL_ASSETS_URL' => 'http://localhost/',
]

?>