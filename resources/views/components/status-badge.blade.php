<span {{ $attributes->merge(['class' => 'badge fs-5 text-bg-' . $enum->color()]) }}>
    {{ $enum->label() }}
</span>
