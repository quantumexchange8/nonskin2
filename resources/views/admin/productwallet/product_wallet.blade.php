@extends('layouts.master')
@section('title') @lang('translation.Sales') @lang('translation.Report') @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ route('admin-dashboard') }} @endslot
    @slot('li_1') @lang('translation.Dashboard') @endslot
    @slot('title') @lang('translation.Product Wallet Adjustment') @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table id="allMember" class="stripe nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User ID</th>
                                <th>Referral ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Ranking</th>
                                <th>Joined Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->id }}</td>
                                <td class="fw-bold">{{ $user->referrer_id }}</td>
                                <td>{{ $user->full_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->contact }}</td>
                                <td>{{ $user->rank->name}}</td>
                                <td>{{ $user->created_at->format('d/m/Y, h:i:s') }}</td>
                                <td>
                                    <div class="d-flex gap-1 align-items-center">
                                        <a href="{{ route('productWalletAdjustment', $user->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-bs-original-title="Edit" class="text-success">
                                            <i class="mdi mdi-pencil font-size-18"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script>
        new DataTable('#allMember', {
            responsive: true,
            pagingType: 'simple_numbers',
            lengthChange: false
        });
    </script>
@endsection