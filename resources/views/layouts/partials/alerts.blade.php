@if (session('success'))
    <div class="alert alert-success" role="alert">
        Success: {{ session('success') }}
    </div>
@endif
@if (session('danger'))
    <div class="alert alert-danger" role="alert">
        Danger: {{ session('danger') }}
    </div>
@endif
@if (session('warning'))
    <div class="alert alert-warning" role="alert">
        Warning: {{ session('warning') }}
    </div>
@endif
@if (session('info'))
    <div class="alert alert-info" role="alert">
        Info: {{ session('info') }}
    </div>
@endif
