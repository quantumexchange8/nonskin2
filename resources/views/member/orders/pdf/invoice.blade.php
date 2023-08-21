

<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>
</head>
<style type="text/css">
    body {
        font-family: 'Roboto Condensed', sans-serif;
    }

    .m-0 {
        margin: 0px;
    }

    .p-0 {
        padding: 0px;
    }

    .pt-5 {
        padding-top: 5px;
    }

    .mt-10 {
        margin-top: 10px;
    }

    .text-center {
        text-align: center !important;
    }

    .w-100 {
        width: 100%;
    }

    .w-50 {
        width: 50%;
    }

    .w-90 {
        width: 90%;
    }

    .w-80 {
        width: 80%;
    }

    .w-70 {
        width: 70%;
    }

    .w-65 {
        width: 65%;
    }

    .w-35 {
        width: 35%;
    }

    .w-30 {
        width: 30%;
    }

    .w-20 {
        width: 20%;
    }

    .logo img {
        padding-top: 15px;
        width: 100px;
        height: 100px;
        /*  padding-top: 30px; */
    }


    .gray-color {
        color: #5D5D5D;
    }

    .text-bold {
        font-weight: bold;
    }

    .border {
        border: 1px solid black;
    }


    table.table tr,
    table.table th,
    table.table td {
        border: 1px solid #d2d2d2;
        border-collapse: collapse;
        padding: 7px 8px;
    }

    table.table tr th {
        background: #F4F4F4;
        font-size: 15px;
    }

    table.table tr td {
        font-size: 13px;
    }

    table.table {
        border-collapse: collapse;
    }


    .float-left {
        float: left;
    }

    .float-right {
        float: right;
    }

    .total-part {
        font-size: 16px;
        line-height: 12px;
    }

    .total-right p {
        padding-right: 20px;
    }

    .clearfix::after {
        content: "";
        clear: both;
        display: table;
    }

    .text-right {
        text-align: right;

    }

    /*  .table-borderless table,
    .table-borderless td,
    .table-borderless tr {
        border: none !important;
        padding: 0%;
        border-spacing: 0%;
    } */
    .table-borderless td {
        vertical-align: top;
    }
</style>

<body>
    <div class="head-title">
        <h1 class="text-center m-0 p-0">Invoice</h1>
    </div>
    <div class="add-detail mt-10 clearfix">
        <div class="float-left logo">
            <img src="{{ public_path('images/black-logo.jpeg') }}">
        </div>
        <div class="float-right text-right mt-10">
            <p class="m-0 pt-5 text-bold w-100">{{ $companyInfo['name'] }}</p>
            <p class="m-0 pt-5 text-bold w-100">
                @php
                    $addressLines = explode(',', $companyInfo['address']);
                    $formattedAddress = implode(',<br>', $addressLines);
                    echo $formattedAddress;
                @endphp
            </p>

            <p class="m-0 pt-5 text-bold w-100">{{ $companyInfo['contact'] }}</p>
        </div>

        <div style="clear: both;"></div>
    </div>
    <hr />
    {{-- <div class="table-section bill-tbl w-100 mt-10">
        <p>Name: {{ $order['receiver'] }}</p>
        <p>Address: {{ $order['delivery_address'] }}</p>
        <p>Contact : {{ $order['contact'] }}</p>
        <p>Email : {{ $order['email'] }}</p>
        <p>Delivery Method:
            {{ $order['delivery_method'] == 'self_pickup' ? 'Self Pickup' : 'Delivery' }}</p>
    </div> --}}
    {{-- <div class="table-section bill-tbl w-100 mt-10">

        <div class="w-65 float-left">

            <p>Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                {{ $order['receiver'] }}</p>
            <p>Address&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                {{ $order['delivery_address'] }}
            </p>
            <p>Contact&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                {{ $order['contact'] }}</p>
            <p>Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                {{ $order['email'] }}
            </p>
            <p>Delivery Method&nbsp;&nbsp;:
                {{ $order['delivery_method'] == 'self_pickup' ? 'Self Pickup' : 'Delivery' }}</p>
        </div>
        <div class="w-35 float-left">
            <p>Invoice No&nbsp;&nbsp;&nbsp;: {{ $order['order_num'] }}</p>
            <p>Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                {{ \Carbon\Carbon::parse($order['created_at'])->format('d/m/Y') }}</p>
        </div>
        <div style="clear: both;"></div>

    </div> --}}
    <div class="table-section bill-tbl w-100 mt-10">

        <div class="w-65 float-left">
            <table class="table-borderless w-90">
                <tr>
                    <td class="w-30">Name</td>
                    <td width="1%">: </td>
                    <td>{{ $invoice['receiver'] }}</td>
                </tr>
                <tr>
                    <td class="w-30">Address</td>
                    <td width="1%">: </td>
                    <td>{{ $invoice['delivery_address'] }}</td>
                </tr>
                <tr>
                    <td class="w-30">Contact</td>
                    <td width="1%">: </td>
                    <td>{{ $invoice['contact'] }}</td>
                </tr>
                <tr>
                    <td class="w-30">Email</td>
                    <td width="1%">: </td>
                    <td>{{ $invoice['email'] }}</td>
                </tr>
                <tr>
                    <td class="w-30">Delivery Method</td>
                    <td width="1%">: </td>
                    <td>{{ $invoice['delivery_method']  }}</td>
                </tr>
            </table>
        </div>
        <div class="w-35 float-left">
            <table class="table-borderless w-100">
                <tr>
                    <td>Invoice No</td>
                    <td>: {{ $invoice['order_num'] }}</td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td>: {{ \Carbon\Carbon::parse($invoice['created_at'])->format('d/m/Y') }}</td>
                </tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
            </table>
        </div>
        <div style="clear: both;"></div>

    </div>

    <div class="table-section bill-tbl w-100 mt-10">
        <table class="table w-100 mt-10">
            <tr>
                <th class="w-10">#</th>
                <th class="w-60">Product Name</th>
                <th class="w-10">Price</th>
                <th class="w-10">Qty</th>
                <th class="w-10">Total Price</th>
            </tr>
            @php($total = 0)
            @foreach ($orderItems as $item)
                <tr align="center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->product->name }}</td>
                    <td>RM {{ number_format($item['price'],2) }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td align="right">RM {{ number_format($item['price'],2) }}</td>
                </tr>
                @php($total += $item['price'] * $item['quantity'])
            @endforeach
            <tr>
                <td colspan="5">
                    <div class="total-part">
                        <div class="total-left w-70 float-left" align="right">
                            <p>Shipping Fee</p>
                            <p>Grand Total Price</p>
                            <p>Payment Method</p>
                        </div>
                        <div class="total-right w-30 float-left text-bold" align="right">
                            <p>RM {{ number_format($invoice['delivery_fee'],2) }}</p>
                            <p>RM {{ number_format($total + $invoice['delivery_fee'],2) }}</p>
                            <p>{{ $invoice['payment_method'] }}</p>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                </td>
            </tr>
        </table>

        <div class="table-section bill-tbl w-100 mt-10">
            <p>Terms & Conditions:<br>
                1. Goods sold are not refundable nor returnable.<br>
                2. If product is faulty upon receipt, kindly contact our customer service to make a replacement within
                three (3) working days.
            </p>

        </div>
    </div>

</html
