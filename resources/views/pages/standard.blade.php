@extends(backpack_view('blank'))

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>{!! $page->title !!}</h1>
            <hr>
            <div class="content">
                {!! $page->content !!}
            </div>
        </div>
    </div>
</div>
@endsection
