<?php

namespace Tests;

use Laravel\BrowserKitTesting\TestCase as BaseTestCase;

abstract class TestCaseBrowser extends BaseTestCase
{
    use CreatesApplication;

    public $baseUrl = 'http://localhost:8000';
}
