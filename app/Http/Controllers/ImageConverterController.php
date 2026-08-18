<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageConverterController extends Controller
{
    public function index()
    {
        return view('herramientas.imagenes');
    }

    public function convert(Request $request)
    {
        $request->validate([
            'imagen' => 'required|image|mimes:jpeg,jpg,png,gif,webp,bmp|max:10240',
        ]);

        $file = $request->file('imagen');

        $source = $this->loadImage($file->getRealPath());

        if (! $source) {
            return back()->with('error', 'No se pudo procesar la imagen. Asegúrate de que sea un archivo de imagen válido.')->withInput();
        }

        // Tamaño carta a 300 DPI: 8.5" x 11" = 2550 x 3300 px
        $maxWidth = 2550;
        $maxHeight = 3300;

        $srcWidth = imagesx($source);
        $srcHeight = imagesy($source);

        $scale = min($maxWidth / $srcWidth, $maxHeight / $srcHeight);
        $width = max(1, (int) round($srcWidth * $scale));
        $height = max(1, (int) round($srcHeight * $scale));

        $dest = imagecreatetruecolor($width, $height);
        $white = imagecolorallocate($dest, 255, 255, 255);
        imagefill($dest, 0, 0, $white);
        imagecopyresampled($dest, $source, 0, 0, 0, 0, $width, $height, $srcWidth, $srcHeight);

        ob_start();
        imagejpeg($dest, null, 90);
        $jpeg = ob_get_clean();

        imagedestroy($source);
        imagedestroy($dest);

        $data = $this->generarPdfCarta($jpeg, $width, $height);

        $nombre = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        return response($data)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="' . $nombre . '.pdf"');
    }

    private function generarPdfCarta($jpegData, $imgW, $imgH)
    {
        // Tamaño carta en puntos (1 pulgada = 72 pt): 612 x 792
        $pageW = 612;
        $pageH = 792;

        $scale = min($pageW / $imgW, $pageH / $imgH);
        $dispW = $imgW * $scale;
        $dispH = $imgH * $scale;
        $x = ($pageW - $dispW) / 2;
        $y = ($pageH - $dispH) / 2;

        $contenido = "q\n{$dispW} 0 0 {$dispH} {$x} {$y} cm\n/Im1 Do\nQ\n";

        $objetos = [
            1 => '<< /Type /Catalog /Pages 2 0 R >>',
            2 => '<< /Type /Pages /Kids [3 0 R] /Count 1 >>',
            3 => "<< /Type /Page /Parent 2 0 R /MediaBox [0 0 {$pageW} {$pageH}] /Resources << /XObject << /Im1 4 0 R >> >> /Contents 5 0 R >>",
            4 => "<< /Type /XObject /Subtype /Image /Width {$imgW} /Height {$imgH} /ColorSpace /DeviceRGB /BitsPerComponent 8 /Filter /DCTDecode /Length " . strlen($jpegData) . " >>\nstream\n{$jpegData}\nendstream",
            5 => "<< /Length " . strlen($contenido) . " >>\nstream\n{$contenido}endstream",
        ];

        $pdf = "%PDF-1.4\n";
        $offsets = [];

        foreach ($objetos as $id => $cuerpo) {
            $offsets[$id] = strlen($pdf);
            $pdf .= "{$id} 0 obj\n{$cuerpo}\nendobj\n";
        }

        $xrefPos = strlen($pdf);
        $pdf .= "xref\n0 " . (count($objetos) + 1) . "\n0000000000 65535 f \n";
        for ($i = 1; $i <= count($objetos); $i++) {
            $pdf .= sprintf("%010d 00000 n \n", $offsets[$i]);
        }

        $pdf .= "trailer\n<< /Size " . (count($objetos) + 1) . " /Root 1 0 R >>\nstartxref\n{$xrefPos}\n%%EOF\n";

        return $pdf;
    }

    private function loadImage($path)
    {
        $info = @getimagesize($path);

        if (! $info) {
            return null;
        }

        switch ($info[2]) {
            case IMAGETYPE_JPEG:
                return @imagecreatefromjpeg($path);
            case IMAGETYPE_PNG:
                return @imagecreatefrompng($path);
            case IMAGETYPE_GIF:
                return @imagecreatefromgif($path);
            case IMAGETYPE_WEBP:
                return function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($path) : null;
            case IMAGETYPE_BMP:
                return function_exists('imagecreatefrombmp') ? @imagecreatefrombmp($path) : null;
            default:
                return null;
        }
    }
}