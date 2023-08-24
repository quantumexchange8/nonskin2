@extends('layouts.master')
@section('title')
    Member Network Tree
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('url')
            {{ url('/') }}
        @endslot
        @slot('li_1')
            Home
        @endslot
        @slot('title')
            Member Network Tree
        @endslot
    @endcomponent

    <div class="card">
        {{-- <div class="card-body p-4">
            <h5 class="card-title">@lang('public.search')</h5>
            <hr /> --}}

            @if (session('success_message'))
                <div class="alert border-0 alert-dismissible fade show py-2">
                    <div class="d-flex align-items-center">
                        <div class="font-35 text-white"><i class='bx bxs-check-circle'></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0 text-white">@lang('public.success')</h6>
                            <div class="text-white">{{ session('success_message') }}</div>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert border-0 alert-dismissible fade show py-2">
                    <div class="d-flex align-items-center">
                        <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0 text-white">@lang('public.error')</h6>
                            <div class="text-white">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            {{-- <form method="post" action="{{ url('members/tree') }}">@csrf
                <div class="form-body mt-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="border border-3 p-4 rounded">
                                <input type="hidden" name="member" id="member">
                                <div class="mb-3">
                                    <label for="Member" class="form-label">@lang('public.member')</label>
                                    <input type="text" class="form-control" id="member_search"
                                        name="member_search" placeholder="@lang('public.member')">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-light">@lang('public.search')</button>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!--end row-->
                </div>
            </form>
        </div> --}}
    </div>
    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="mb-0">@lang('public.member_tree')</h5>
                </div>
            </div>
            <hr>

            <button type="button" class="header btn btn-primary mt-4 mb-2" data-action="expand-all"
                id="expand-all">@lang('public.expand_all')
            </button>

            <div class="dd mw-100 overflow-auto" id="nestable">
                
                <ol class="dd-list">
                    @foreach ($users as $user)
                        @if (count($user->downline))
                            <li class="dd-item dd-collapsed" data-id="{{ $user->id }}">
                                <div class="dd-content" onclick="test(this)">
                                    <p style='color: darkblue;'>
                                        <i class='bx bx-user'></i>
                                        {{ $user->referrer_id . ' | Full Name: ' . $user->full_name . ' | Personal Ranking: ' . $user->personal_ranking_display }}
                                    </p>
                                </div>
                                @include('member.member_subtree', ['downline' => $user->downline])
                            </li>
                        @else
                            <li class="dd-item" data-id="{{ $user->id }}">
                                <div class="dd-content" onclick="test(this)">
                                    <p style='color:lightgreen;'>
                                        <i class='bx bx-user'></i>
                                        {{ $user->referrer_id . ' | Full Name: ' . $user->full_name . ' | Personal Ranking: ' . $user->personal_ranking_display }}
                                    </p>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ol>

            </div>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-white">@lang('public.details')</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div id="user-detail"></div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">@lang('public.close')</button>
        </div>
    </div>
</div>
</div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
    <script src="{{ url('plugins/jquery-nestable/js/jquery.nestable.min.js') }}"></script>

    {{-- <script>
        $('#nestable').nestable({
            onDragStart: function() {
                return false
            },
        });

        $('#collapse-all').hide();
        $('#collapse-all').click(function(e) {
            $('#nestable').nestable('collapseAll');
            $('#expand-all').show();
            $('#collapse-all').hide();
        })
        $('#expand-all').click(function(e) {
            $('#nestable').nestable('expandAll');
            $('#expand-all').hide();
            $('#collapse-all').show();
        })

        var myModal = new bootstrap.Modal(document.getElementById('detailModal'))

        function test(e) {
            $.ajax({
                // url: "{{ url('getUser') }}",
                type: "POST",
                data: {
                    id: $(e).parent().data('id'),
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response) {
                        $('#user-detail').html(response.html)
                        myModal.show();
                    }
                },
                error: function(response) {
                    console.log(response)
                }

            })
            // alert($(e).parent().data('id'));
        }

        $("#member_search").autocomplete({
            source: function(request, response) {
                $.ajax({
                    // url: "{{ url('searchAjaxMemberTree') }}",
                    'method': 'post',
                    dataType: "json",
                    data: {
                        term: request.term,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            select: function(event, ui) {
                $('#member').val(ui.item.id);
            }
        });
    </script> --}}
@endsection
