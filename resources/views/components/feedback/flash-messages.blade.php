@props(['errors' => null])

@if (session()->has('success'))
    <x-ui.sweet-alert type="success" title="Sukses" text="{{ session('success') }}" :show-on-load="true" timer="3000"
        position="top-end" :toast="true" />
@endif

@if (session()->has('error'))
    <x-ui.sweet-alert type="error" title="Error!" text="{{ session('error') }}" :show-on-load="true" timer="3000"
        position="top-end" :toast="true" />
@endif

@if (session()->has('warning'))
    <x-ui.sweet-alert type="warning" title="Warning!" text="{{ session('warning') }}" :show-on-load="true" timer="3000"
        position="top-end" :toast="true" />
@endif

@if (session()->has('info'))
    <x-ui.sweet-alert type="info" title="Information" text="{{ session('info') }}" :show-on-load="true" timer="3000"
        position="top-end" :toast="true" />
@endif

@if (($errors ?? collect())->any())
    @php
        $errorList = implode('\n', ($errors ?? collect())->all());
    @endphp
    <x-ui.sweet-alert type="error" title="Validation Errors" text="{{ $errorList }}" :show-on-load="true"
        timer="5000" position="top-end" :toast="true" />
@endif
