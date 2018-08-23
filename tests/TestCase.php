<?php

namespace Tests;

use App\Proxies;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp()
    {
        parent::setUp();
        Artisan::call('db:seed');
//        $this->user = factory(App\Proxi
        $this->proxy = new Proxies();
    }
}
