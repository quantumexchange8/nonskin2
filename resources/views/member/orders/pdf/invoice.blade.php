<!DOCTYPE html>
<html>

    <head>
        <title>Invoice</title>
    </head>

    <body>
        <div class="head-title">
            <h1 class="text-center m-0 p-0">Invoice</h1>
        </div>

        <div class="add-detail mt-10 clearfix">
            <div class="float-left logo">
                {{-- <img src="{{ public_path('images/black-logo.jpeg') }}"> --}}
            </div>
            <div class="float-right text-right mt-10">
                <p class="m-0 pt-5 text-bold w-100">{{ $companyInfo['Name']['value'] }}</p>
                @php($address = explode("\n", $companyInfo['Address']['value']))
                @foreach ($address as $row)
                    <p class="m-0 pt-5 text-bold w-100">{{ $row }}</p>
                @endforeach
    
                <p class="m-0 pt-5 text-bold w-100">{{ $companyInfo['Contact']['value'] }}</p>
            </div>
    
            <div style="clear: both;"></div>
        </div>

        <hr />

        <div class="table-section bill-tbl w-100 mt-10">

            <div class="w-65 float-left">
                <table class="table-borderless w-90">
                    <tr>
                        <td class="w-30">Name</td>
                        <td>: {{ $invoice['receiver'] }}</td>
                    </tr>
                    <tr>
                        <td class="w-30">Address</td>
                        <td>: {{ $invoice['delivery_address'] }}</td>
                    </tr>
                    <tr>
                        <td class="w-30">Contact</td>
                        <td>: {{ $invoice['contact'] }}</td>
                    </tr>
                    <tr>
                        <td class="w-30">Email</td>
                        <td>: {{ $invoice['email'] }}</td>
                    </tr>
                    <tr>
                        <td class="w-30">Delivery Method</td>
                        <td>: {{ $invoice['delivery_method'] == 'self_pickup' ? 'Self Pickup' : 'Delivery' }}</td>
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
                        <td>{{ $item->product->name_en }}</td>
                        <td>{{ number_format($item['price']) }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ number_format($item['price'], 2) }} * {{ $item['quantity'] }}</td>
                    </tr>
                    @php($total += $item['price'] * $item['quantity'])
                @endforeach
                <tr>
                    <td colspan="5">
                        <div class="total-part">
                            <div class="total-left w-70 float-left" align="right">
                                <p>Shipping Fee</p>
                                <p>Grand Total Price</p>
                            </div>
                            <div class="total-right w-30 float-left text-bold" align="right">
                                <p>RM {{ number_format($invoice['delivery_fee'], 2) }}</p>
                                <p>RM {{ number_format($total + $invoice['delivery_fee'], 2) }}</p>
                            </div>
                            <div style="clear: both;"></div>
                        </div>
                    </td>
                </tr>
            </table>
    
            {{-- <div class="table-section bill-tbl w-100 mt-10">
                <p>Terms & Conditions:<br>
                    1. Goods sold are not refundable nor returnable.<br>
                    2. If product is faulty upon receipt, kindly contact our customer service to make a replacement within
                    three (3) working days.
                </p>
    
            </div> --}}
        </div>
    </body>

</html>