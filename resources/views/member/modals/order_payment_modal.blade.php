<div class="modal fade" id="orderPaymentModal_{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="orderPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderPaymentModalLabel">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <a href="{{ route('invoice', $order->id) }}" target="_blank">
                    <button class="btn btn-success">
                        Print
                    </button>
                </a>
            </div>
            <div class="modal-body">
                <p class="mb-2">Order Id: <span class="text-primary" id="order-id">{{$order->order_num}}</span></p>
                <p class="mb-2">Receiver Name: <span class="text-primary" id="receiver-name">{{$order->receiver}}</span></p>
                <p class="mb-2">Deliver Address: <span class="text-primary" id="receiver-name">{{$order->delivery_address}}</span></p>
                <p class="mb-2">Status: <span class="text-primary" id="receiver-name">@if($order->status == 9) <span style="color:red">Pending Payment</span> @endif</span></p>
                <p class="mb-2">Courier: <span class="text-primary" id="receiver-name">{{$order->courier}}</span></p>
                <p class="mb-2">Consignment Note: <span class="text-primary" id="receiver-name">{{$order->cn}}</span></p>
                <p class="mb-4">Tracking Number: <span class="text-primary" id="receiver-name">{{$order->tracking_no}}</span></p>
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap">
                        <thead>
                            <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $order_item)
                            <tr>
                                <th scope="row">
                                    <div>
                                        <img src="{{ asset('images/products/' . $order_item->product->image_1) }}" alt="" class="avatar-md">
                                    </div>
                                </th>
                                <td>
                                    <div>
                                        <h5 class="text-truncate font-size-14">
                                            {{ $order_item->product->name }}
                                        </h5>
                                        <p class="text-muted mb-0">RM {{ number_format($order_item->product->price, 2) }} x {{ $order_item->quantity}}</p>
                                    </div>
                                </td>
                                <td>
                                    @if($order_item->product->discount != 0 )
                                        <del><small>RM {{ number_format($order_item->product->price, 2)}}</small></del> <small>{{ $order_item->product->discount}}%</small>
                                        <br>
                                        RM {{ number_format($order_item->price, 2)}}
                                    @else
                                        RM {{ number_format($order_item->price, 2)}}
                                    @endif

                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td align="right" colspan="2">
                                    <h6 class="m-0 text-right">Total:</h6>
                                </td>
                                <td>
                                    RM {{ number_format($order->price, 2)}}
                                </td>
                            </tr>
                            <tr>
                                <td align="right" colspan="2">
                                    <h6 class="m-0 text-right">Shipping:</h6>
                                </td>
                                <td>
                                    RM {{ number_format($order->delivery_fee, 2) }}
                                </td>
                            </tr>
                            <tr>
                                <td align="right" colspan="2">
                                    <h6 class="m-0 text-right">Total Discount:</h6>
                                </td>
                                <td>
                                   - RM {{ number_format($order->discount_amt, 2) }}
                                </td>
                            </tr>
                            <tr>
                                <td align="right" colspan="2">
                                    <h6 class="m-0 text-right">Total:</h6>
                                </td>
                                <td>
                                    RM {{ number_format($order->total_amount, 2)}}
                                </td>
                            </tr>
                            <tr>
                                <td align="right" colspan="2">
                                    <h6 class="m-0 text-right">Payment Method:</h6>
                                </td>
                                <td>
                                    {{ $order->payment_method }}
                                </td>
                            </tr>
                            @if($order->status == 6 || $order->status == 5)
                            <tr>
                                <td align="right" colspan="2">
                                    <h6 class="m-0 text-right">Status:</h6>
                                </td>
                                <td>
                                    @if($order->status == 6)
                                        <span class="badge badge-pill badge-soft-danger font-size-14">
                                            Rejected
                                        </span>
                                    @elseif($order->status == 5)
                                        <span class="badge badge-pill badge-soft-danger font-size-14">
                                            Pending refund
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td align="right" colspan="2">
                                    <h6 class="m-0 text-right">Remark:</h6>
                                </td>
                                <td>
                                    {{ $order->remarks }}
                                </td>
                            </tr>
                            @endif



                        </tbody>
                    </table>
                </div>
            <form action="{{ route('uploadpayment', $order->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="payment_proof">Payment Slip</label>
                <div class="input-group">
                    <input type="file" class="form-control" id="payment_proof" name="payment_proof">
                    <button type="submit" class="btn btn-success">Upload</button>
                </div>
            </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
