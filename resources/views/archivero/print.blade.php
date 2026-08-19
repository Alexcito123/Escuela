<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Imprimir - {{ $archive->title }}</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, Helvetica, sans-serif; background: #f1f5f9; color: #1e293b; }
        .bar { background: #ffffff; border-bottom: 1px solid #e2e8f0; padding: 12px 20px; display: flex; align-items: center; justify-content: space-between; gap: 12px; position: sticky; top: 0; z-index: 10; }
        .bar h1 { font-size: 16px; font-weight: 700; }
        .bar p { font-size: 12px; color: #64748b; margin-top: 2px; }
        .bar button { background: #059669; color: #fff; border: none; padding: 10px 22px; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; }
        .bar button:hover { background: #047857; }
        .content { max-width: 900px; margin: 20px auto; padding: 0 20px; }
        .file-block { background: #fff; border-radius: 10px; box-shadow: 0 1px 3px rgba(0,0,0,.08); margin-bottom: 20px; overflow: hidden; }
        .file-block .head { padding: 10px 16px; border-bottom: 1px solid #e2e8f0; font-size: 13px; font-weight: 600; color: #475569; display: flex; justify-content: space-between; gap: 10px; }
        .file-block .head span { color: #94a3b8; font-weight: 400; }
        .file-body { padding: 16px; text-align: center; }
        .file-body img { max-width: 100%; max-height: 1050px; display: block; margin: 0 auto; }
        .file-body embed { width: 100%; height: 90vh; border: none; display: block; }
        .notice { padding: 24px; text-align: center; color: #64748b; font-size: 14px; }
        .notice a { color: #059669; font-weight: 600; }
        @media print {
            .bar { display: none; }
            body { background: #fff; }
            .content { max-width: 100%; margin: 0; padding: 0; }
            .file-block { box-shadow: none; border-radius: 0; margin-bottom: 0; break-after: page; }
            .file-block .head { display: none; }
            .file-body embed { height: auto; }
        }
    </style>
</head>
<body>
    <div class="bar">
        <div>
            <h1>{{ $archive->title }}</h1>
            <p>{{ $archive->folder->name }} · {{ $archive->folder->grade->name }} · {{ count($files) }} archivo(s)</p>
        </div>
        <button onclick="window.print()">Imprimir</button>
    </div>

    <div class="content">
        @foreach ($files as $file)
            @php
                $isImage = str_starts_with($file['mime'], 'image/');
                $isPdf = str_contains($file['mime'], 'pdf');
                $url = asset('storage/' . $file['path']);
            @endphp
            <div class="file-block">
                <div class="head">
                    <span>{{ $file['original_name'] }}</span>
                </div>
                <div class="file-body">
                    @if ($isImage)
                        <img src="{{ $url }}" alt="{{ $file['original_name'] }}">
                    @elseif ($isPdf)
                        <embed src="{{ $url }}#toolbar=0&navpanes=0" type="application/pdf">
                    @else
                        <div class="notice">
                            Este tipo de archivo no se puede imprimir directamente.
                            <a href="{{ route('archivero.download', $archive) }}">Descárgalo aquí</a>.
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <script>
        window.onload = function () {
            setTimeout(function () { window.print(); }, 400);
        };
    </script>
</body>
</html>