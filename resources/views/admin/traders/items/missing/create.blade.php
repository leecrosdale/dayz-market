@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __("Creating {$missing} as Item") }}</div>

                    <div class="card-body table-responsive">
                        @include('shared.status')

                        <form method="post" action="{{ route('admin.items.store.trader', $trader) }}">

                            @csrf

                            <input type="hidden" name="trader_id" value="{{ $trader->id }}" />

                            <div class="form-group">
                                <label for="class_name">Class Name</label>
                                <input type="text" class="form-control" name="class_name" value="{{ $missing }}"/>
                            </div>


                            <div class="form-group">
                                <label for="item_type">Item Type</label>
                                <select id="item_type" type="text" class="form-control" name="item_type_id">
                                    @foreach(\App\Models\ItemType::orderBy('name')->get() as $itemType)
                                        <option value="{{ $itemType->id }}">{{ $itemType->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="min_price">Min Price Threshold</label>
                                <input type="number" class="form-control" name="min_price" value="1"/>
                            </div>

                            <div class="form-group">
                                <label for="max_price">Max Price Threshold</label>
                                <input type="number" class="form-control" name="max_price" value="1"/>
                            </div>

                            <div class="form-group">
                                <label for="sell_price_percent">Sell Price Percent</label>
                                <input type="number" class="form-control" name="sell_price_percent" value="-1"/>
                            </div>

                            <div class="form-group">
                                <label for="min_stock">Min Stock Threshold</label>
                                <input type="number" class="form-control" name="min_stock" value="1"/>
                            </div>

                            <div class="form-group">
                                <label for="max_stock">Max Stock Threshold</label>
                                <input type="number" class="form-control" name="max_stock" value="1"/>
                            </div>

                            <div class="form-group py-4">
                                <button type="submit" class="btn btn-primary">Convert</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
