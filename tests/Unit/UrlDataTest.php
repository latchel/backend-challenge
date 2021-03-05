<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Url;
use App\User;
use App\UrlData;

class UrlDataTest extends TestCase
{
    use RefreshDatabase;

    public function testNameIsSavedInUrlAfterSavingUrlData()
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

        $data = UrlData::create([
            'url_id' => $url->url_id,
            'title' => 'some title',
            'description' => 'some description',
            'image' => 'image.jpg',
            'url' => $url->url,
        ]);

        $this->assertDatabaseHas('url', [
            'url_id' => $url->url_id,
            'name' => $data->title
        ]);

    }
}
