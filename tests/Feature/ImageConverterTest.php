<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageConverterTest extends TestCase
{
    use RefreshDatabase;

    public function test_converts_image_to_pdf_letter_size(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $gd = imagecreatetruecolor(200, 100);
        ob_start();
        imagejpeg($gd, null, 90);
        $jpeg = ob_get_clean();
        imagedestroy($gd);

        Storage::fake('local');

        $file = UploadedFile::fake()->createWithContent('foto.jpg', $jpeg);

        $response = $this->post(route('imagenes.convert'), [
            'imagen' => $file,
        ]);

        $response->assertOk();
        $this->assertSame('application/pdf', $response->headers->get('Content-Type'));
        $this->assertStringContainsString('attachment; filename="foto.pdf"', $response->headers->get('Content-Disposition'));

        $content = $response->getContent();
        $this->assertStringStartsWith('%PDF-1.4', $content);
        $this->assertStringContainsString('/MediaBox [0 0 612 792]', $content);
        $this->assertStringContainsString('/Filter /DCTDecode', $content);
        $this->assertStringContainsString('%%EOF', $content);
    }
}