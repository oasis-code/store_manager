@extends('layouts.app3')

@section('title', 'Chemicals ')
@section('page_title', 'Chemicals')

@section('bread_crumb')
    <ol class="breadcrumb float-sm-right">
        <a href="{{ route('chemicals.create') }}" class="btn float-right bg-success"><i class="fa fa-plus"></i> New Chemical
        </a>
    </ol>
@endsection

@section('main_content')

    <div class="col-sm-12">
        <div class="card card-success card-outline">
            <div class="card-header">
                <h4 class="card-title text-success">Seed treatment Chemicals</h4>
            </div>
            <div class="card-body table-responsive">
                <table id="example2" class="table table-hover table-head-fixed table-sm table-striped">
                    <thead>
                        <tr>
                            
                            <th>Name</th>
                            <th>Code</th>
                            <th>Purpose</th>
                            <th>Rate</th>
                            <th>Pack Qty</th>
                            <th>Tons</th>
                            <th>unit cost</th>
                            <th>pack cost</th>
                            <th>Balance</th>
                            <th>Bal.cost</th>
                            <th>Bal.Tons</th>
                        </tr>
                    </thead>
                    <tbody>
                        @unless ($seed_chemicals->isEmpty())
                            @foreach ($seed_chemicals as $chemical)                          
                            @php
                            $tons = $chemical->quantity_per_pack / $chemical->rate;
                            $pack_cost =  $chemical->unit_price * $chemical->quantity_per_pack;
                            $balance_cost =  $chemical->balance * $chemical->unit_price;
                            $balance_tons = $chemical->balance / $chemical->rate;
                            @endphp
                                <tr class="text-nowrap">
                                    <td><a href="{{ route('chemicals.edit', ['chemical' => $chemical]) }}">{{ $chemical->name }}</a>
                                    </td>
                                    <td>{{ $chemical->code }}</td>
                                    <td>{{ $chemical->purpose }}</td>
                                    <td>{{ $chemical->rate }} @if ($chemical->unit_of_measure === 'lt') lt/ton @else Kg/ton @endif</td>
                                    <td>{{ $chemical->quantity_per_pack }}</td>
                                    <td>{{ $tons }}</td>
                                    <td>{{ number_format($chemical->unit_price, 1, '.', ',') }}</td>
                                    <td>{{ number_format($pack_cost, 1, '.', ',') }}</td>
                                    <td>{{ $chemical->balance }}</td>
                                    <td>{{ number_format($balance_cost, 1, '.', ',') }} </td>  
                                    <td>{{ $balance_tons }}</td>                           

                                </tr>
                            @endforeach
                        @else
                            <tr class="border-gray-300">
                                <td colspan="10">
                                    <p class="text-center">No Seed Treatment Chemicals Found</p>
                                </td>
                            </tr>
                        @endunless
                    </tbody>
                </table>
            </div> <!-- /.card-body -->
        </div>
    </div>

    
    <div class="col-sm-12">
        <div class="card card-success card-outline">
            <div class="card-header">
                <h4 class="card-title text-success">Farm Chemicals</h4>
            </div>
            <div class="card-body table-responsive">
                <table id="example3" class="table table-hover table-head-fixed table-sm table-striped">
                    <thead>
                        <tr>
                            
                            <th>Name</th>
                            <th>Code</th>
                            <th>Purpose</th>
                            <th>Rate</th>
                            <th>Pack Qty</th>
                            <th>Ha</th>
                            <th>unit cost</th>
                            <th>pack cost</th>
                            <th>Balance</th>
                            <th>Bal.cost</th>
                            <th>Bal.Ha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @unless ($farm_chemicals->isEmpty())
                            @foreach ($farm_chemicals as $chemical)                          
                            @php
                            $tons = $chemical->quantity_per_pack / $chemical->rate;
                            $pack_cost =  $chemical->unit_price * $chemical->quantity_per_pack;
                            $balance_cost =  $chemical->balance * $chemical->unit_price;
                            $balance_Ha = $chemical->balance / $chemical->rate;
                            @endphp
                                <tr class="text-nowrap">
                                    <td><a href="{{ route('chemicals.edit', ['chemical' => $chemical]) }}">{{ $chemical->name }}</a>
                                    </td>
                                    <td>{{ $chemical->code }}</td>
                                    <td>{{ $chemical->purpose }}</td>
                                    <td>{{ $chemical->rate }} @if ($chemical->unit_of_measure === 'lt') lt/Ha @else Kg/Ha @endif</td>
                                    <td>{{ $chemical->quantity_per_pack }}</td>
                                    <td>{{ $tons }}</td>
                                    <td>{{ number_format($chemical->unit_price, 1, '.', ',') }}</td>
                                    <td>{{ number_format($pack_cost, 1, '.', ',') }}</td>
                                    <td>{{ $chemical->balance }}</td>
                                    <td>{{ number_format($balance_cost, 1, '.', ',') }} </td>  
                                    <td>{{ $balance_Ha }}</td>                           

                                </tr>
                            @endforeach
                        @else
                            <tr class="border-gray-300">
                                <td colspan="10">
                                    <p class="text-center">No Farm Chemicals Found</p>
                                </td>
                            </tr>
                        @endunless
                    </tbody>
                </table>
            </div> <!-- /.card-body -->
        </div>
    </div>

@endsection
