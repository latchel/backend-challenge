<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Url;
use App\User;

class UrlsTest extends TestCase
{
    use RefreshDatabase;

    public function testSaveUrl()
    {
        $user = User::create([
            'name' => 'Hugo',
            'email' => 'tech@latchel.com',
            'password' => '123123'
        ]);

        $url =  Url::create([
            'user_id' => $user->id,
            'url' => 'latchel.com'
        ]);

        $response = $this->actingAs($user)->post('/api/urls', [
            'user_id' => $user->id,
            'link' => 'latchel.com'
        ]);

        $response->assertJsonFragment([
            'url' => 'https://latchel.com/',
            'title' => 'Home | Latchel',
        ]);
    }

    public function testGetUrls()
    {
        $user = User::create([
            'name' => 'Hugo',
            'email' => 'tech@latchel.com',
            'password' => '123123'
        ]);

        $url =  Url::create([
            'user_id' => $user->id,
            'url' => 'latchel.com'
        ]);

        $response = $this->actingAs($user)->get('/api/urls');

        $response->assertJsonFragment([
            'url' => 'latchel.com',
        ]);
    }
}
