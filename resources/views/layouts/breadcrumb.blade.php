<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $page->title ?? '' }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    @if(isset($breadcrumb) && isset($breadcrumb->list))
                        @foreach($breadcrumb->list as $key => $value)
                            @if($key == count($breadcrumb->list) - 1)
                                <li class="breadcrumb-item active">{{ $value }}</li>
                            @else
                                <li class="breadcrumb-item">{{ $value }}</li>
                            @endif
                        @endforeach
                    @endif
                </ol>
            </div>
        </div>
    </div>
</section>
