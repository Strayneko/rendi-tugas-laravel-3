<div @class([
    'alert',
    'alert-success',
    'alert-dismissible',
    'fade',
    'show',
    'col-md-4',
    'mx-auto',
]) role="alert">
    <strong>Success!</strong> {{ $message }}
    <button type="button" @class(['btn-close']) data-bs-dismiss="alert" aria-label="Close"></button>
</div>
