@extends('layouts.master')
@section('title')
    Wallet Adjustment
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('url') {{ url('/') }} @endslot
        @slot('li_1') Home @endslot
        @slot('url2') {{ route('member-list') }} @endslot
        @slot('li_2') Wallet Adjustment @endslot
        @slot('title') {{ $user->full_name }} @endslot
    @endcomponent

    @include('includes.alerts')

    <style>
        .custom-excel-button {
            background-color: #2b8972;
            color: #ffffff;
            width: 100px;
            height: 40px;
            border: none;
            border-radius: 10px;
        }
        .dt-buttons {
            display: flex;
            justify-content: flex-end; /* Adjust as needed */
            margin-bottom: 30px; /* Adjust as needed */
        }
        .dataTables_wrapper .dataTables_filter input[type="search"] {
            /* Your custom styles here */
            /* display: block;
            width: 100%; */
            padding: 0.47rem 0.75rem;
            font-size: .875rem;
            font-weight: 400;
            line-height: 1.6;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #e2e5e8;
            /* Add more styles as needed */
        }
    </style>

    <form action="{{ route('productWalletUpdate', $user->id) }}" method="POST" id="updateProfileForm">
        @csrf
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-body justify-content-center">
                        <div class="text-center">
                            <h5 class="mt-3 mb-1">{{ $user->full_name }}</h5>
                        </div>
                        <div class="mt-3 row">
                            <h2 class="col-lg-2 col-md-3 col-form-label fw-bold font-size-20 py-0">Wallet Details</h2>
                            <div class="col-lg-8 col-md-9">
                                <label class="col-lg-2 col-md-3 col-form-label">
                                </label>
                            </div>
                        </div>
                        <hr>

                        <div class="mb-3 row">
                            <label for="referral" class="col-lg-2 col-md-3 col-form-label">Select Wallet</label>
                            <div class="col-lg-8 col-md-9">
                                <select class="form-select" name="wallet_type" id="wallet_type">
                                    {{-- <option class="form-select" disabled>---please select---</option> --}}
                                    <option class="form-select" value="cash_wallet" selected>Cash Wallet</option>
                                    <option class="form-select" value="product_wallet">Product Wallet</option>
                                    <option class="form-select" value="purchase_wallet">Purchase Wallet</option>
                                </select>
                            </div>
                        </div>

                        <div id="product_wallet_fields">
                            <div class="mb-3 row">
                                <label for="referral" class="col-lg-2 col-md-3 col-form-label">Product Wallet Balance</label>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" class="form-control" value="{{ number_format($user->product_wallet, 2) }}" name="product_balance" disabled>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="referral" class="col-lg-2 col-md-3 col-form-label">Select Type</label>
                                <div class="col-lg-8 col-md-9">
                                    <select class="form-select" name="type" id="type">
                                        {{-- <option class="form-select" disabled>---please select---</option> --}}
                                        <option class="form-select" value="deposit" selected>Deposit</option>
                                        <option class="form-select" value="withdrawal">Withdrawal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="referral" class="col-lg-2 col-md-3 col-form-label required">Amount</label>
                                <div class="col-lg-8 col-md-9">
                                    <input type="number" class="form-control" name="product_amount" required min="1">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="remark" class="col-lg-2 col-md-3 col-form-label">Remark<small> (Optional) </small></label>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" class="form-control" name="remarks">
                                </div>
                            </div>
                        </div>
                            
                        <div id="cash_wallet_fields">
                            <div class="mb-3 row">
                                <label for="referral" class="col-lg-2 col-md-3 col-form-label">Cash Wallet Balance</label>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" class="form-control" value="{{ number_format($user->cash_wallet, 2) }}" name="cash_balance" disabled>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="referral" class="col-lg-2 col-md-3 col-form-label required">Amount</label>
                                <div class="col-lg-8 col-md-9">
                                    <input type="number" class="form-control" name="cash_amount" required min="1">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="username" class="col-lg-2 col-md-3 col-form-label">Remark<small> (Optional) </small></label>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" class="form-control" name="remark">
                                </div>
                            </div>
                        </div>

                        <div id="purchase_wallet_fields">
                            <div class="mb-3 row">
                                <label for="referral" class="col-lg-2 col-md-3 col-form-label">Purchase Wallet Balance</label>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" class="form-control" value="{{ number_format($user->purchase_wallet, 2) }}" name="purchase_balance" disabled>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="referral" class="col-lg-2 col-md-3 col-form-label">Select Type</label>
                                <div class="col-lg-8 col-md-9">
                                    <select class="form-select" name="purchase_type" id="type">
                                        {{-- <option class="form-select" disabled>---please select---</option> --}}
                                        <option class="form-select" value="deposit" selected>Deposit</option>
                                        <option class="form-select" value="withdrawal">Withdrawal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="referral" class="col-lg-2 col-md-3 col-form-label required">Amount</label>
                                <div class="col-lg-8 col-md-9">
                                    <input type="number" class="form-control" name="purchase_amount" required min="1">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="username" class="col-lg-2 col-md-3 col-form-label">Remark<small> (Optional) </small></label>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" class="form-control" name="remark">
                                </div>
                            </div>
                        </div>
                        
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary btn-sm" id="updateProfile"><i class="mdi mdi-pencil me-1"></i>Update Wallets</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <table id="WalletAdjustment" class="stripe nowrap" style="width:100%">
                            <div style="display: flex;align-items: flex-end;justify-content: center;padding-left: 26px;padding-right: 26px;padding-bottom: 30px;">
                                <div class="col-lg-4" style="width:100%">
                                    <label class="form-label">Date</label>
                                    <input type="date" id="date-filter-input" class="form-control">
                                </div>
                                <div style="margin-left: 10px;">
                                    <form>
                                        <button class="btn btn-primary" type="submit" value="reset">
                                            <i class="mdi mdi-refresh"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Full Name</th>
                                    <th>Wallet Type</th>
                                    <th>Type</th>
                                    <th>Remarks</th>
                                    <th>Cash In</th>
                                    <th>Cash Out</th>
                                    <th>Balance</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rows as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->updated_at->format('d/m/Y') }}</td>
                                        <td>{{ $row->user ? $row->user->full_name : null }}</td>
                                        <td>{{ $row->wallet_type }}</td>
                                        <td>{{ $row->type }}</td>
                                        <td>{{ $row->remarks }}</td>
                                        @if ($row->cash_in == 0)
                                            <td>
                                                -
                                            </td>
                                        @else
                                            <td class="text-success fw-bold">
                                                RM {{ number_format($row->cash_in,2) }}
                                            </td>
                                        @endif
                                        @if ($row->cash_out == 0)
                                            <td>
                                                -
                                            </td>
                                        @else
                                            <td class="text-danger fw-bold">
                                                RM {{ number_format($row->cash_out,2) }}
                                            </td>
                                        @endif
                                        <td>
                                            RM {{ number_format($row->balance,2) }}
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script>
        $(document).ready(function() {
                
                var table = $('#WalletAdjustment').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend: 'excel',
                            text: 'Export Excel',
                            className: 'custom-excel-button'
                        }
                    ],
                    "columnDefs": [
                        {
                            "targets": [1],
                            "type": "date-range",
                            "searchable": true
                        }
                    ],
                    language: {
                        search: 'Search:'
                    }
                });

                // Add an event listener to the date input field
                $('#date-filter-input').on('change', function() {
                    var selectedDate = $(this).val();
                    if (selectedDate) {
                        // Use DataTables search to filter rows based on a custom function
                        $.fn.dataTable.ext.search.push(
                            function(settings, data, dataIndex) {
                                var dateColumn = data[1]; // Assuming date is in the second column
                                // Format the selected date to match the database format ('YYYY-MM-DD HH:mm:ss')
                                var formattedDate = moment(selectedDate, 'YYYY-MM-DD').format('YYYY-MM-DD');
                                return dateColumn.includes(formattedDate);
                            }
                        );
                        // Redraw the DataTable to apply the filter
                        table.draw();
                        // Remove the custom filter function to avoid interference with other searches
                        $.fn.dataTable.ext.search.pop();
                    } else {
                        // If no date is selected, clear the filter
                        table.search('').draw();
                    }
                });
            });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Number mask
            let contactInputs = document.querySelectorAll('.contact-input');
            contactInputs.forEach(input => {
                IMask(input, {
                    mask: '00000000000'
                });
            });

            let postcodeInputs = document.querySelectorAll('.postcode-input');
            postcodeInputs.forEach(input => {
                IMask(input, {
                    mask: '00000'
                });
            });

            let bankAccNoInputs = document.querySelectorAll('.bank-acc-no-input');
            bankAccNoInputs.forEach(input => {
                IMask(input, {
                    mask: '00000000000000000'
                });
            });

            let idInputs = document.querySelectorAll('.id-input');
            idInputs.forEach(input => {
                IMask(input, {
                    mask: '000000000000'
                });
            });

            // ... Add other input masks as needed

            // Add an event listener to each form's submit button
            const forms = [
                { id: "updateProfileForm", submitButtonId: "updateProfile" },
                // Add other forms here...
            ];
            forms.forEach((formInfo) => {
                const form = document.getElementById(formInfo.id);
                const submitButton = form.querySelector(`#${formInfo.submitButtonId}`);
                submitButton.addEventListener("click", function(event) {
                    if (!validateForm(formInfo.id)) {
                        event.preventDefault(); // Prevent form submission if validation fails
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var walletSelect = document.getElementById("wallet_type");
            var cashWalletFields = document.getElementById("cash_wallet_fields");
            var productWalletFields = document.getElementById("product_wallet_fields");
            var purchaseWalletFields = document.getElementById("purchase_wallet_fields");

            var cashAmountInput = document.querySelector("#cash_wallet_fields input[name='cash_amount']");
            var productAmountInput = document.querySelector("#product_wallet_fields input[name='product_amount']");
            var purchaseAmountInput = document.querySelector("#purchase_wallet_fields input[name='purchase_amount']");

            // Initially hide both sets of fields and disable their inputs
            cashWalletFields.style.display = "block";
            cashAmountInput.disabled = false;

            productWalletFields.style.display = "none";
            productAmountInput.disabled = true;

            purchaseWalletFields.style.display = "none";
            purchaseAmountInput.disabled = true;

            walletSelect.addEventListener("change", function() {
                if (walletSelect.value === "cash_wallet") {
                    cashWalletFields.style.display = "block";
                    cashAmountInput.disabled = false;

                    productWalletFields.style.display = "none";
                    productAmountInput.disabled = true;

                    purchaseWalletFields.style.display = "none";
                    purchaseAmountInput.disabled = true;

                } else if (walletSelect.value === "product_wallet") {
                    cashWalletFields.style.display = "none";
                    cashAmountInput.disabled = true;

                    productWalletFields.style.display = "block";
                    productAmountInput.disabled = false;

                    purchaseWalletFields.style.display = "none";
                    purchaseAmountInput.disabled = true;

                } else if (walletSelect.value === "purchase_wallet") {
                    cashWalletFields.style.display = "none";
                    cashAmountInput.disabled = true;

                    productWalletFields.style.display = "none";
                    productAmountInput.disabled = true;

                    purchaseWalletFields.style.display = "block";
                    purchaseAmountInput.disabled = false;

                } else {
                    // Handle any other cases if needed
                    cashWalletFields.style.display = "none";
                    cashAmountInput.disabled = true;

                    productWalletFields.style.display = "none";
                    productAmountInput.disabled = true;

                    purchaseWalletFields.style.display = "none";
                    purchaseAmountInput.disabled = true;

                }
            });
        });
    </script>

@endsection
