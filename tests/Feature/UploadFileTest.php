<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadFileTest extends TestCase
{
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_avatars_upload_large_()
    {
        Storage::fake('files');

        $validFile = UploadedFile::fake()->image('avatar.jpg')->size(100);
        $response = $this->post('/upload-file', [
            'avatar' => $validFile,
        ]);
        
        Storage::disk('local')->assertExists('files/' . $validFile->hashName());
        
        $invalidFile = UploadedFile::fake()->image('avatar.jpg')->size(103);
        $response = $this->post('/upload-file', [
            'avatar' => $invalidFile,
        ]);
        $response->assertStatus(302);
    }
}
