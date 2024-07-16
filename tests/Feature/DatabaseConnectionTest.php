<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DatabaseConnectionTest extends TestCase
{
    use RefreshDatabase;

    public function testDatabaseConnection()
    {
        try
        {
            DB::connection()->getPdo();
            $this->assertTrue(true, 'Conexão estabelecida com a database teste.');
        } catch (\Exception $e)
        {
            $this->fail('Não foi possível estabelecer conexão com a database: ' . $e->getMessage());
        }
    }
}
