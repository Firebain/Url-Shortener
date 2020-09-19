@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Url list</div>

                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse ($short_urls as $short_url)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <p>URL: <a href="{{ $short_url->url }}">{{ $short_url->url }}</a></p>
                                <p>Short URL: <a href="{{ $short_url->path }}">{{ $short_url->path }}</a></p>
                            </div>

                            <span class="badge badge-primary badge-pill">{{ $short_url->hits }}</span>
                        </li>
                        @empty
                        <li class="list-group-item d-flex">
                            Url list is empty
                        </li>
                        @endforelse
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
