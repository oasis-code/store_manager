@extends('layouts.app')

@section('title', 'Fuel In ')
@section('page_title', 'Fuel In')

@section('bread_crumb')
    <ol class="breadcrumb float-sm-right">
        <a href="{{ route('fuel-in.create') }}" class="btn float-right bg-success"><i class="fa fa-plus"></i> New
            Fuel In Transaction
        </a>
    </ol>
@endsection

@section('main_content')

    <div class="col-sm-12">
        <div class="card card-success card-outline">
            <div class="card-header">
                <h4 class="card-title text-success">Total Fuel Balance:
                    <b>{{ $fuelbal = number_format($balance, 1, '.', ',') }} Litres</b> in stock</h4>
            </div>

            <div class="card-body table-responsive">
                <table id="example2" class="table table-hover table-head-fixed table-sm table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Date</th>
                            <th>Vehicle Number</th>
                            <th>Driver</th>
                            <th>Authorized by</th>
                            <th>Quantity (litres)</th>

                        </tr>
                    </thead>
                    <tbody>
                        @unless ($transactions->isEmpty())


                            @foreach ($transactions as $transaction)
                                <tr class="text-nowrap">
                                    <td>{{ $transaction->id }}</td>
                                    <td>{{ $transaction->date }}</td>
                                    <td>{{ strtoupper(substr($transaction->vehicle->category->name, 0, 1)) }}/{{ $transaction->vehicle->model }}/{{ $transaction->vehicle->number_plate }}
                                    </td>
                                    <td>{{ $transaction->person->name }}</td>
                                    <td>{{ $transaction->user->name }}</td>
                                    <td><b>{{ number_format($transaction->quantity, 1, '.', ',') }}</b></td>

                                </tr>
                            @endforeach
                        @else
                            <tr class="border-gray-300">
                                <td colspan="10">
                                    <p class="text-center">No Transactions Found</p>
                                </td>
                            </tr>
                        @endunless
                    </tbody>
                </table>
            </div>

        </div>
        <div class="pb-3">
            {{ $transactions->links() }}
        </div>
    </div>

@endsection
