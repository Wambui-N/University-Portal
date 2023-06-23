@props(['href', 'activeUrl', 'icon', 'label', 'linkId' => ''])

<li class="nav-item rounded py-1 bg-none">
    <a href="{{ $href }}" class="nav-link {{ Str::endsWith($href, $activeUrl) ? 'link-offset-2' : '' }}" id="{{ $linkId }}">
        <i class="nav-icon fas {{ $icon }}" style="color: #38445a;"></i>
        <p class="fs-6 nav-link-color text-uppercase fw-normal">
            {{ $label }}
        </p>
    </a>
</li>
