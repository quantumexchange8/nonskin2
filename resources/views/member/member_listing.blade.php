@extends('layouts.master')
@section('title') Member Listing @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ url('/') }} @endslot
    @slot('li_1') Home @endslot
    @slot('title') Member Listing @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table id="memberNetwork" class="stripe nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Joined Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $member)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $member->full_name }}</td>
                                    <td>{{ $member->email }}</td>
                                    <td>{{ $member->contact }}</td>
                                    <td>{{ $member->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('member.member-detail', $member->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="View" data-bs-original-title="View" class="text-primary">
                                            <i class="mdi mdi-eye-outline font-size-18"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
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
        new DataTable('#memberNetwork', {
            responsive: true,
            pagingType: 'simple_numbers'
        });
    </script>
@endsection
