@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __("Traders that use {$item->class_name}") }}</div>

                    <div class="card-body table-responsive">
                        @include('shared.status')

                        @foreach($item->trader_items as $traderItem)
                            <p>{{ $traderItem->trader->display_name }}</p>
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
