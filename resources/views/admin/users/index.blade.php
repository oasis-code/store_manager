@extends('layouts.app')


@section('page_title', 'Users')

@section('bread_crumb')
    <ol class="breadcrumb float-sm-right">
        <a href="{{ route('admin.users.create') }}" class="btn float-right bg-success"><i
            class="fa fa-plus"></i> New
        User
    </a>
    </ol>
@endsection

@section('main_content')


    <div class="col-sm-12">
        <div class="card card-success card-outline">
           
            <div class="card-body table-responsive">
                <table id="example2" class="table table-hover table-head-fixed table-sm table-striped">
                    <thead>
                        <tr>
                           
                            <th>Name</th>                            
                            <th>Email</th>
                            <th>role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @unless ($users->isEmpty())
                            @foreach ($users as $nowuser)
                                <tr class="text-nowrap">
                                    <td><a
                                            href="{{ route('admin.users.edit', ['nowuser' => $nowuser]) }}">{{ $nowuser->name }}</a>
                                    </td> 
                                     <td>{{ $nowuser->email }}</td>
                                    <td>{{ $nowuser->role }}</td>
                                   
                                </tr>
                            @endforeach
                        @else
                            <tr class="border-gray-300">
                                <td colspan="10">
                                    <p class="text-center">No Users Found</p>
                                </td>
                            </tr>
                        @endunless
                    </tbody>
                </table>
            </div> <!-- /.card-body -->
        </div>
    </div>

@endsection
