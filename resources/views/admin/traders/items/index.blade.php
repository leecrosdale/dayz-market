@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __("{$trader->display_name}'s Items") }}</div>

                    <div class="card-body table-responsive">
                        @include('shared.status')


                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Status</th>
                                <th>File</th>
                                <th>Initial Stock Percentage</th>
                                <th>Name</th>
                                <th>Min Price</th>
                                <th>Max Price</th>
                                <th>Sell Price Percent</th>
                                <th>Min Stock</th>
                                <th>Max Stock</th>
                                <th>Attachments</th>
                                <th>Variants</th>
                                <th>View</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->item->item_type->filename }}</td>
                                    <td>{{ $item->item->item_type->init_stock_percent }}</td>
                                    <td>{{ $item->item->class_name }}</td>
                                    <td>{{ $item->item->min_price_threshold }}</td>
                                    <td>{{ $item->item->max_price_threshold }}</td>
                                    <td>{{ $item->item->sell_price_percent }}</td>
                                    <td>{{ $item->item->min_stock_threshold }}</td>
                                    <td>{{ $item->item->max_stock_threshold }}</td>
                                    <td>{{ count($item->item->spawn_attachments) ?? 0 }}</td>
                                    <td>{{ count($item->item->variants) ?? 0 }}</td>
                                    <td><a href="{{ route('admin.traders.items.remove', [$trader, $item]) }}">Remove</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
