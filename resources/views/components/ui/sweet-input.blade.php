@props([
    'title' => 'Enter value',
    'inputType' => 'text',
    'inputPlaceholder' => 'Enter your input...',
    'confirmText' => 'Submit',
    'cancelText' => 'Cancel',
    'action' => '',
    'method' => 'POST',
    'inputName' => 'input_value',
    'functionName' => 'sweetInput',
    'validation' => true,
])

<script>
    function {{ $functionName }}() {
        Swal.fire({
            title: '{{ $title }}',
            input: '{{ $inputType }}',
            inputPlaceholder: '{{ $inputPlaceholder }}',
            showCancelButton: true,
            confirmButtonText: '{{ $confirmText }}',
            cancelButtonText: '{{ $cancelText }}',
            confirmButtonColor: '#3b82f6',
            cancelButtonColor: '#6b7280',
            @if ($validation)
                inputValidator: (value) => {
                    if (!value) {
                        return 'You need to enter a value!'
                    }
                }
            @endif
        }).then((result) => {
            if (result.isConfirmed && result.value) {
                @if ($action)
                    // Create and submit form with input value
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ $action }}';

                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    form.appendChild(csrfToken);

                    @if ($method !== 'POST')
                        const methodField = document.createElement('input');
                        methodField.type = 'hidden';
                        methodField.name = '_method';
                        methodField.value = '{{ $method }}';
                        form.appendChild(methodField);
                    @endif

                    const inputField = document.createElement('input');
                    inputField.type = 'hidden';
                    inputField.name = '{{ $inputName }}';
                    inputField.value = result.value;
                    form.appendChild(inputField);

                    document.body.appendChild(form);
                    form.submit();
                @else
                    {{ $slot }}
                @endif
            }
        });
    }
</script>
