<div class="modal fade" id="orderdetailsModal_{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="orderdetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderdetailsModalLabel">Order Details</h5>
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
                <p class="mb-2">Courier: <span class="text-primary" id="receiver-name">{{$order->courier}}</span></p>
                <p class="mb-2">Consignment Note: <span class="text-primary" id="receiver-name">{{$order->cn}}</span></p>
                <p class="mb-4">Tracking Number: <span class="text-primary" id="receiver-name">{{$order->tracking_no}}</span></p>
                @if($order->payment_method == 'Manual Transfer')
                    <p class="mb-4">
                        Payment Slip:
                        <span class="text-primary" id="receiver-name">
                            <button class="btn btn-success" data-toggle="modal" data-target="#paymentSlipModal">View</button>
                        </span>
                    </p>
                @endif
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
                                    RM {{ number_format($order->total_amount, 2)}}
                                </td>
                            </tr>
                            <tr>
                                <td align="right" colspan="2">
                                    <h6 class="m-0 text-right">Total Discount:</h6>
                                </td>
                                <td>
                                    RM {{ number_format($order->discount_amt, 2)}}
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
                    @if($order->payment_method == 'Manual Transfer')
                        <div style="display: flex;justify-content: center;">
                            <img src="{{ asset('images/payment-proof/' . $order->payment_proof) }}" class="object-fit-cover" style="height: 450px" alt="Order Payment Proof" >
                        </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
