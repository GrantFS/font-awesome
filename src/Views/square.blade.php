<span class="fa-stack">
    <span class="fa-stack-2x fas fa-square {{ $item->getFrameClass() }}"
        data-fa-transform="{{ $item->hasFrameTransform() ? $item->getFrameTransform() : '' }}"></span>
    <span class="fas fa-{{ $item->getName() }} {{ $item->getClass() }} fa-stack-1x fa-inverse" data-fa-transform="{{ $item->getTransform() }}"></span>
</span>
