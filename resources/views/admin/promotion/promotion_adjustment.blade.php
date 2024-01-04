@extends('layouts.master')
@section('content')
    
@section('css')
    <link href="{{ URL::asset('assets/libs/choices.js/choices.js.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/@simonwep/@simonwep.min.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.css') }}">
@endsection

    {{-- <style>

        .table .table-light {
            background-color: #f8f9fa;
        }
    </style> --}}

    <form action="{{ route('promotionAdd') }}" method="POST">
        @csrf
        <div class="row" style="display: none">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Colorpicker</h4>
                        <p class="card-title-desc">Flat, Simple, Hackable Color-Picker.</p>
                    </div>
                    <div class="card-body">

                        <div class="text-center">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mt-4">
                                        <h5 class="font-size-14">Classic Demo</h5>
                                        <div class="classic-colorpicker"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mt-4">
                                        <h5 class="font-size-14">Monolith Demo</h5>
                                        <div class="monolith-colorpicker"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mt-4">
                                        <h5 class="font-size-14">Nano Demo</h5>
                                        <div class="nano-colorpicker"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-body justify-content-center">
                        <div class="mt-3 row">
                            <h2 class="col-lg-2 col-md-3 col-form-label fw-bold font-size-20 py-0">Promotion</h2>
                            <div class="col-lg-8 col-md-9">
                                <label class="col-lg-2 col-md-3 col-form-label">
                                </label>
                            </div>
                        </div>
                        <hr>

                        <div class="mb-3 row">
                            <label for="referral" class="col-lg-2 col-md-3 col-form-label">Promotion Date</label>
                            <input type="text" id="datepicker-range" name="datepicker_range" class="form-control">
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary btn-sm" id="updateProfile"><i class="mdi mdi-pencil me-1"></i>Add Promotion</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table class="table" style="width:100%">
                        <h2 class="col-lg-2 col-md-3 col-form-label fw-bold font-size-20 py-0">Promotion Log</h2>
                        <hr>
                        <thead class="table-light">
                            <tr>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="background: white">{{ $rows->start_date }}</td>
                                <td style="background: white">{{ $rows->end_date }}</td>
                                <td style="background: white">
                                    @if($status == "Ongoing")
                                        <b style="color: rgb(0, 170, 0)">{{$status}}</b>
                                    @else
                                        <b style="color: red">{{$status}}</b>
                                    @endif
                                </td>
                                {{-- <td style="background: white">
                                    <a href="{{ route('productWalletAdjustment', $user->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-bs-original-title="Edit" class="text-success">
                                        <i class="mdi mdi-pencil font-size-18"></i>
                                    </a>
                                </td> --}}
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
    
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/choices.js/choices.js.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/@simonwep/@simonwep.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/form-advanced.init.js') }}"></script>

@endsection