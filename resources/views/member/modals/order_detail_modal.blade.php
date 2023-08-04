<div class="modal fade" id="orderdetailsModal_{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="orderdetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderdetailsModalLabel">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-2">Order Id: <span class="text-primary" id="order-id">{{$order->order_num}}</span></p>
                <p class="mb-4">Receiver Name: <span class="text-primary" id="receiver-name">{{$order->receiver}}</span></p>
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
                                            {{ $order_item->product->name_en }}
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
                                <td colspan="2">
                                    <h6 class="m-0 text-right">Sub Total:</h6>
                                </td>
                                <td>
                                    RM {{ number_format($order->total_amount, 2)}}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h6 class="m-0 text-right">Shipping:</h6>
                                </td>
                                <td>
                                    RM {{ number_format($order->delivery_fee, 2) }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h6 class="m-0 text-right">Total:</h6>
                                </td>
                                <td>
                                    RM {{ number_format($order->total_amount, 2)}}
                                </td>
                            </tr>



                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>