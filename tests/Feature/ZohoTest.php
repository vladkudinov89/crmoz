<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ZohoTest extends TestCase
{

    public function testDeal()
    {
         $this->withoutExceptionHandling();

         $data = [
            'name' => 'test',
            'stage' => "automobile",
        ];

        $response = $this
            ->post('api/deal/create' ,  $data)
            ->assertStatus(200);
    } 

    public function testTask()
    {
         $this->withoutExceptionHandling();

         $data = [
                    'subject' => "Multi_Line_1",
        ];

        $response = $this
            ->post('api/task/create' ,  $data)
            ->assertStatus(200);
    }


}
