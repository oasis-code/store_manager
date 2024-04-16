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
                <h4 class="card-title text-success"><b>Seed treatment Chemicals</b></h4>
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
                            <th>Bal.packs</th>
                            <th>Bal.Qty</th>
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
                            $balace_q = $chemical->balance * $chemical->quantity_per_pack;
                            $balance_cost =  $balace_q * $chemical->unit_price;
                            $balance_tons = $balace_q / $chemical->rate;
                            @endphp
                                <tr class="text-nowrap">
                                    <td><a href="{{ route('chemicals.edit', ['chemical' => $chemical]) }}">{{ $chemical->name }}</a>
                                    </td>
                                    <td>{{ $chemical->code }}</td>
                                    <td>{{ $chemical->purpose }}</td>
                                    <td>{{ $chemical->rate }} @if ($chemical->unit_of_measure === 'lt') lt/ton @else Kg/ton @endif</td>
                                    <td>{{ $chemical->quantity_per_pack }}</td>
                                    <td>{{ number_format($tons, 2, '.', ',') }}</td>
                                    <td>{{ number_format($chemical->unit_price, 0, '.', ',') }}</td>
                                    <td>{{ number_format($pack_cost, 0, '.', ',') }}</td>
                                    <td>{{ $chemical->balance }}</td>
                                    <td>{{ $balace_q }}</td>
                                    <td>{{ number_format($balance_cost, 0, '.', ',') }} </td>  
                                    <td>{{ number_format($balance_tons, 2, '.', ',') }}</td>                          

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

    
    <div class="col-sm-12 mb-5">
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title text-success"><b>Farm Chemicals</b></h3>
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
                            <th>Bal.packs</th>
                            <th>Bal.Qty</th>
                            <th>Bal.cost</th>
                            <th>Bal.Ha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @unless ($farm_chemicals->isEmpty())
                            @foreach ($farm_chemicals as $chemical)                          
                            @php
                            
                            $ha = $chemical->quantity_per_pack / $chemical->rate;
                            $pack_cost =  $chemical->unit_price * $chemical->quantity_per_pack;
                            $balace_q = $chemical->balance * $chemical->quantity_per_pack;
                            $balance_cost =  $balace_q * $chemical->unit_price;
                            $balance_Ha = $balace_q / $chemical->rate;
                            @endphp
                                <tr class="text-nowrap">
                                    <td><a href="{{ route('chemicals.edit', ['chemical' => $chemical]) }}">{{ $chemical->name }}</a>
                                    </td>
                                    <td>{{ $chemical->code }}</td>
                                    <td>{{ $chemical->purpose }}</td>
                                    <td>{{ $chemical->rate }} @if ($chemical->unit_of_measure === 'lt') lt/Ha @else Kg/Ha @endif</td>
                                    <td>{{ $chemical->quantity_per_pack }}</td>
                                    <td>{{ number_format($ha, 2, '.', ',') }}</td>
                                    <td>{{ number_format($chemical->unit_price, 0, '.', ',') }}</td>
                                    <td>{{ number_format($pack_cost, 0, '.', ',') }}</td>
                                    <td>{{ $chemical->balance }}</td>
                                    <td>{{ $balace_q }}</td>
                                    <td>{{ number_format($balance_cost, 0, '.', ',') }} </td>  
                                    <td>{{ number_format($balance_Ha, 2, '.', ',') }}</td>                          

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
