@php
    $videoUrl = $data['data']->video_link ?? '';
    $isDirectVideo = false;
    $isEmbed = false;

    if ($videoUrl) {
        // Check if it's a stored file
        if (Str::startsWith($videoUrl, 'storage/')) {
            $videoUrl = asset($videoUrl);
            $isDirectVideo = true;
        }
        // Check direct video file extensions
        elseif (preg_match('/\.(mp4|webm|ogg|mov)(\?.*)?$/i', $videoUrl)) {
            $isDirectVideo = true;
        }
        // Convert youtu.be/ID → youtube.com/embed/ID
        elseif (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $videoUrl, $m)) {
            $videoUrl = 'https://www.youtube.com/embed/' . $m[1];
            $isEmbed = true;
        }
        // Convert youtube.com/watch?v=ID → youtube.com/embed/ID
        elseif (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $videoUrl, $m)) {
            $videoUrl = 'https://www.youtube.com/embed/' . $m[1];
            $isEmbed = true;
        }
        // Already embed URL
        elseif (str_contains($videoUrl, 'youtube.com/embed') || str_contains($videoUrl, 'player.vimeo')) {
            $isEmbed = true;
        }
        // Vimeo
        elseif (preg_match('/vimeo\.com\/(\d+)/', $videoUrl, $m)) {
            $videoUrl = 'https://player.vimeo.com/video/' . $m[1];
            $isEmbed = true;
        }
        else {
            $isEmbed = true; // try iframe as fallback
        }
    }
@endphp

@if (!$videoUrl)
    <div class="text-center py-4 text-muted">
        <i class="bx bx-video-off bx-lg mb-2 d-block"></i>
        <p>No video provided.</p>
    </div>
@elseif ($isDirectVideo)
    <video class="w-100" height="400" controls style="background:#000;">
        <source src="{{ $videoUrl }}">
        Your browser does not support the video tag.
        <a href="{{ $videoUrl }}" target="_blank" class="btn btn-primary mt-2">Download Video</a>
    </video>
@elseif ($isEmbed)
    <iframe class="w-100" height="400" src="{{ $videoUrl }}" frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        allowfullscreen></iframe>
@else
    <div class="text-center py-4">
        <i class="bx bx-video bx-lg text-muted mb-2 d-block"></i>
        <a href="{{ $videoUrl }}" target="_blank" class="btn btn-primary">
            <i class="bx bx-play me-1"></i> Watch Video
        </a>
    </div>
@endif