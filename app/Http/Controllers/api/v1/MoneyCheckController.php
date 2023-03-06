<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Services\OdataService;

class MoneyCheckController extends Controller
{
    private OdataService $service;

    public function __construct(OdataService $service)
    {
        $this->service = $service;
    }

    public function setData(): void
    {
        $this->service->setData($this->service->getMoneyCheck());
    }
}
