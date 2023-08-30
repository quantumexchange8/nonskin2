@extends('layouts.master')
@section('title') @lang('translation.Network-tree') @endsection

@section('content')
    @component('components.breadcrumb')
        @slot('url') {{ route('admin-dashboard') }} @endslot
        @slot('li_1') @lang('translation.Dashboard') @endslot
        @slot('title') @lang('translation.Network-tree') @endslot
    @endcomponent
    <style>
        .icon-lg {
            font-size: 16px; /* Adjust the size as needed */
        }
        li {
            list-style: none;
        }
        /* .dd-content {
            background: rgb(255, 255, 255);
            border-radius: 5px;
            border: none;
            height: 50px;
            margin: 7px 0;
        } */
    </style>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin-networktree') }}" method="get">
                <div>
                    <label>Search User</label>
                    <input type="text" class="form-control" name="code" placeholder="Search ID">
                </div>
                <br>
                <button class="btn btn-success" type="submit">Search</button>
                <button class="btn btn-danger" type="submit" value="reset">reset</button>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="card col-lg-12 col-sm-3 col-md-3">
                @if ($admins->isNotEmpty())
                <div id="sponsor">
                  <div class="mt-10 dd mw-100 overflow-auto" id="nestable" class="content">
                    <ol class="dd-list ">
                      @foreach($admins as $admin)
                        @if (count($admin->downline))
                            <li class="dd-item" data-id="{{ $admin->id }}">
                                <div class="dd-content box-bg-color">
                                    <p style='color:#000000;' class="user-card">
                                        @if (count($admin->downline))
                                            <button class="toggle-downline btn" data-target="#downline-{{ $admin->id }}">
                                                <i class="mdi mdi-account-plus icon-lg"></i>
                                            </button>
                                        @endif
                                        <i class='bx bx-user'></i>
                                        {{ $admin->referrer_id . ' | ' . __('translation.Full Name') . ': ' . $admin->full_name . ' | Personal Ranking: ' . $admin->rank_id }}
                                    </p>
                                </div>
                                <div id="downline-{{ $admin->id }}" class="downline" style="display: none;">
                                    @include('member.network.sub_network.network-child', [
                                        'children' => $admin->downline,
                                    ])
                                </div>


                            </li>
                        @else
                            <li class="dd-item" data-id="{{ $admin->id }}">
                                <div class="dd-content box-bg-color">
                                    <p style='color:#000000;'>
                                        <i class='bx bx-user'></i>
                                        {{ $admin->referrer_id . ' | ' . __('translation.Full Name') . ': ' . $admin->full_name . ' | Ranking: ' . $admin->rank_id }}
                                    </p>
                                </div>
                            </li>
                        @endif
                      @endforeach
                    </ol>
                  </div>

                </div>
              @else
                <label>@lang('public.no_users_found')</label>
              @endif
              </div>


        </div>
    </div>

@endsection

@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
    {{-- <script src="{{ url('plugins/jquery-nestable/js/jquery.nestable.min.js') }}"></script> --}}

    <script>
        $(document).ready(function() {
            // Add a click event listener to all buttons with class "toggle-downline"
            $(".toggle-downline").click(function() {
                // Find the target downline container using the data-target attribute
                var target = $(this).data("target");

                // Toggle the visibility of the downline container
                $(target).slideToggle();

                // Check the current state of the icon
                var currentState = $(this).data("state");

                // Change the button's HTML to use MDI icons and update the state
                if (currentState === "visible") {
                    $(this).html('<i class="mdi mdi-account-plus icon-lg"></i>'); // Change to plus icon
                    $(this).data("state", "hidden");
                } else {
                    $(this).html('<i class="mdi mdi-account-remove icon-lg"></i>'); // Change to minus icon
                    $(this).data("state", "visible");
                }
            });
        });

    </script>

@endsection
