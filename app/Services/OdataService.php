<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\MoneyCheck;
use DateTimeImmutable;
use Kily\Tools1C\OData\Client;

class OdataService
{
    public function getMoneyCheck(
        DateTimeImmutable $date_start = new DateTimeImmutable('2022-10-01'),
        DateTimeImmutable $date_end = new DateTimeImmutable('2022-12-31')
    ): array {
        $client = new Client('https://ru.enote.link/08efd710-4709-478f-bac1-2d1b7e209599/odata/standard.odata/', [
            'auth' => [
                env('ODATA_LOGIN'),
                env('ODATA_PASS'),
            ],
        ]);

        return $client->{'Document_ДенежныйЧек'}->filter(
            "Date ge datetime'{$date_start->format('Y-m-d')}T00:00:00' and Date le datetime'{$date_end->format('Y-m-d')}T23:59:59'"
        )->get()->values();
    }

    public function setData(array $data): void
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

