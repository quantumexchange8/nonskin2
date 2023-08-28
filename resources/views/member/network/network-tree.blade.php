@extends('layouts.master')
@section('title')
    Member Network Tree
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('url') {{ url('/members/dashboard') }} @endslot
        @slot('li_1') @lang('translation.Dashboard') @endslot
        @slot('title') Member Network Tree @endslot
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
            <form action="{{ route('networktree') }}" method="get">
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
                @if ($users->isNotEmpty())
                <div id="sponsor">
                  <div class="mt-10 dd mw-100 overflow-auto" id="nestable" class="content">
                    <ol class="dd-list ">
                      @foreach($users as $user)
                        @if (count($user->downline))
                            <li class="dd-item" data-id="{{ $user->id }}">
                                <div class="dd-content box-bg-color">
                                    <p style='color:#000000;' class="user-card">
                                        @if (count($user->downline))
                                            <button class="toggle-downline btn" data-target="#downline-{{ $user->id }}">
                                                <i class="mdi mdi-account-plus icon-lg"></i>
                                            </button>
                                        @endif
                                        <i class='bx bx-user'></i>
                                        {{ $user->referrer_id . ' | ' . __('public.Full Name') . ': ' . $user->full_name . ' | Personal Ranking: ' . $user->rank_id }}
                                    </p>
                                </div>
                                <div id="downline-{{ $user->id }}" class="downline" style="display: none;">
                                    @include('member.network.sub_network.network-child', [
                                        'children' => $user->downline,
                                    ])
                                </div>


                            </li>
                        @else
                            <li class="dd-item" data-id="{{ $user->id }}">
                                <div class="dd-content box-bg-color">
                                    <p style='color:#000000;'>
                                        <i class='bx bx-user'></i>
                                        {{ $user->referrer_id . ' | ' . __('public.Full Name') . ': ' . $user->full_name . ' | Ranking: ' . $user->rank_id }}
                                    </p>
                                </div>
                            </li>
                        @endif
                      @endforeach
                    </ol>
                  </div>

                </div>
              @else
                <label>No user found</label>
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
