<div @class([
    'alert',
    'alert-danger',
    'alert-dismissible',
    'fade',
    'show',
    'col-md-4',
    'mx-auto',
]) role="alert">
    <strong>Error!</strong> {{ $message }}
    <button type="button" @class(['btn-close']) data-bs-dismiss="alert" aria-label="Close"></button>
</div>
