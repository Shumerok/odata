<?php


// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\OdataService;
use Tests\TestCase;

class OdataServiceTest extends TestCase
{

    public function testConnect(): void
    {
        $serv = new OdataService();

        dd($serv->getMoneyCheck());
    }
}
