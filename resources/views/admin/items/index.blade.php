@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Items') }}</div>

                    <div class="card-body table-responsive">
                        @include('shared.status')

                        <div class="form-group">
                            <form method="get" action="{{ route('admin.items.index') }}">
                                <label for="search">Search</label>
                                <input type="text" id="search" value="{{ request()->search }}" name="search" class="form-control" placeholder="File, Name">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </form>
                        </div>

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>File</th>
                                <th>Initial Stock Percentage</th>
                                <th>Name</th>
                                <th>Traders</th>
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
                                    <td>{{ $item->item_type->filename }}</td>
                                    <td>{{ $item->item_type->init_stock_percent }}</td>
                                    <td>{{ $item->class_name }}</td>
                                    <td>{{ $item->trader_items()->count() }}</td>
                                    <td>{{ $item->min_price_threshold }}</td>
                                    <td>{{ $item->max_price_threshold }}</td>
                                    <td>{{ $item->sell_price_percent }}</td>
                                    <td>{{ $item->min_stock_threshold }}</td>
                                    <td>{{ $item->max_stock_threshold }}</td>
                                    <td>{{ count($item->spawn_attachments) ?? 0 }}</td>
                                    <td>{{ count($item->variants) ?? 0 }}</td>
                                    <td><a href="{{ route('admin.items.show', $item) }}">View</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                        <div class="container">
                            {{ $items->links('pagination::bootstrap-4') }}
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
