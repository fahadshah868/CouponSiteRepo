
<?php

use Carbon\Carbon;

$date = Carbon::now();

return [
    'TODAY_DATE' => $date->toDateString(),
    'PANEL_ASSETS_URL' => 'http://localhost/',
    'EXPIRES_AT' => $date->endOfDay(),
]

?>