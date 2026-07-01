<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Visitor Registration - My India Living')</title>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
</head>
<body>


    <!-- Main Content Slot -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        @if(isset($settings['footer_links']) && count($settings['footer_links']) > 0)
            <div style="margin-bottom: 0.75rem; display: flex; justify-content: center; gap: 15px; flex-wrap: wrap; font-size: 0.85rem;">
                @foreach($settings['footer_links'] as $link)
                    @if($link['enabled'] ?? true)
                        <a href="{{ $link['url'] }}" target="_blank" style="color: #cbd5e0; text-decoration: none; opacity: 0.85; transition: opacity 0.2s;" onmouseover="this.style.opacity=1" onmouseout="this.style.opacity=0.85">{{ $link['label'] }}</a>
                    @endif
                @endforeach
            </div>
        @endif
        @if(isset($settings['footer_text_lines']) && count($settings['footer_text_lines']) > 0)
            @foreach($settings['footer_text_lines'] as $line)
                <p style="margin: 4px 0; font-size: 0.85rem; opacity: 0.9;">
                    @if(!empty($line['link_url']))
                        <a href="{{ $line['link_url'] }}" target="_blank" style="color: var(--primary-orange); text-decoration: none;">{{ $line['text'] }}</a>
                    @else
                        {{ $line['text'] }}
                    @endif
                </p>
            @endforeach
        @else
            <p>&copy; {{ isset($settings) ? ($settings['footer_year'] ?? date('Y')) : date('Y') }} <a href="{{ isset($settings) ? ($settings['footer_copyright_link'] ?? 'https://myindialiving.com') : 'https://myindialiving.com' }}" target="_blank">{{ isset($settings) ? ($settings['footer_copyright_text'] ?? 'My India Living') : 'My India Living' }}</a>. All rights reserved.</p>
            <p style="font-size: 0.75rem; margin-top: 0.5rem; opacity: 0.7;">{{ isset($settings) ? ($settings['footer_subtitle'] ?? 'Expo Visitor Registration System') : 'Expo Visitor Registration System' }}</p>
        @endif
    </footer>

    <!-- Scripts Section -->
    @yield('scripts')
</body>
</html>
