<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\MoneyCheck;
use Kily\Tools1C\OData\Client;

class OdataService
{

    public function getMoneyCheck(): array
    {
        $client = new Client('https://ru.enote.link/08efd710-4709-478f-bac1-2d1b7e209599/odata/standard.odata/', [
            'auth' => [
                env('ODATA_LOGIN'),
                env('ODATA_PASS'),
            ],
        ]);

        $date_start = env('ODATA_DATE_START');
        $date_end = env('ODATA_DATE_END');

        return $client->{'Document_ДенежныйЧек'}->filter(
            "Date ge datetime'{$date_start}T00:00:00' and Date le datetime'{$date_end}T23:59:59'"
        )->get()->values();
    }

    public function setData(array $data)
    {
        foreach ($data as $value) {
            MoneyCheck::create([
                'ref_key' => $value['Ref_Key'],
                'data_version' => $value['DataVersion'],
                'deletion_mark' => $value['DeletionMark'],
                'number' => $value['Number'],
                'date' => $value['Date'],
                'posted' => $value['Posted'],
            ]);
        }
    }
}

