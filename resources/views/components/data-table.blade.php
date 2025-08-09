<div class="card">

    <div class="card-header d-flex justify-content-between ">
        <h3 class="card-title btn-block">{{ $title ?? 'DataTable' }}</h3>

        @if(isset($route))
        <a href="{{ $route}}" type="button" class="btn btn-info " style="width: 200px"><i class="fa fa-plus"></i> Create </a>
        @endif
    </div>
    <div class="card-body">
        {{ $slot }}
    </div>
</div>
