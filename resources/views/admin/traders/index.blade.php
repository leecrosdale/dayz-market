@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Traders (' . $traders->count() . ')') }}</div>

                    <div class="card-body table-responsive">
                        @include('shared.status')

{{--                        <div class="form-group">--}}
{{--                            <form method="get" action="{{ route('admin.items.index') }}">--}}
{{--                                <label for="search">Search</label>--}}
{{--                                <input type="text" id="search" value="{{ request()->search }}" name="search" class="form-control" placeholder="File, Name">--}}
{{--                                <button type="submit" class="btn btn-primary">Search</button>--}}
{{--                            </form>--}}
{{--                        </div>--}}

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>File</th>
                                <th>Trader Name</th>
                                <th>Display Name</th>
                                <th>Icon</th>
                                <th>Categories</th>
                                <th>Items</th>
                                <td>Missing Items</td>
                                <th>View</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($traders as $trader)
                                <tr>
                                    <td>{{ $trader->filename }}</td>
                                    <td>{{ $trader->trader_name }}</td>
                                    <td>{{ $trader->display_name }}</td>
                                    <td>{{ $trader->icon }}</td>
                                    <td>{{ $trader->categories->implode('name', ', ') }}</td>
                                    <td><a href="{{ route('admin.traders.items.index', $trader) }}">{{ $trader->trader_items()->count() }}</a></td>
                                    <td><a href="{{ route('admin.traders.items.missing.index', $trader) }}">{{ count($trader->missing_items) ?? 0 }}</a></td>
                                    <td><a href="#">View</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                        <div class="container">
                            {{ $traders->links('pagination::bootstrap-4') }}
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
