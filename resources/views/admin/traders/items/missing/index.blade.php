@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __("{$trader->display_name}'s missing items (" . count($missingItems) . ")") }}</div>

                    <div class="card-body table-responsive">
                        @include('shared.status')

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Convert to Item</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($missingItems as $missingItem)
                                <tr>
                                    <td>{{ $missingItem }}</td>
                                    <td><a href="{{ route('admin.traders.items.missing.convert', [$trader,$missingItem]) }}">Convert</a></td>
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
