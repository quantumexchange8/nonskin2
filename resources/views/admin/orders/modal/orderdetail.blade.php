<div class="modal fade" id="orderdetailsModal_{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="orderdetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderdetailsModalLabel">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
                
                <div class="modal-body">
                    <p class="mb-2">Order Id: <span class="text-primary" id="order-id">{{$order->order_num}}</span></p>
                    <p class="mb-2">Receiver Name: <span class="text-primary" id="receiver-name">{{$order->receiver}}</span></p>
                    @if($order->delivery_method == 'Self-Pickup')
                    <p class="mb-2">Delivery Method: <span class="text-primary" id="receiver-name">{{$order->delivery_method}}</span></p>
                    <p class="mb-4">Self-Pickup Address: <span class="text-primary" id="receiver-name">{{$order->delivery_address}}</span></p>
                    @else
                    <p class="mb-2">Deliver Method: <span class="text-primary" id="receiver-name">{{$order->delivery_method}}</span></p>
                    <p class="mb-2">Deliver Address: <span class="text-primary" id="receiver-name">{{$order->delivery_address}}</span></p>
                    @endif
                    <p class="mb-2">Status: 
                        <span class="text-primary" id="receiver-name">
                            @if($order->status == 1)
                                <span class="badge badge-pill badge-soft-secondary font-size-14">
                                    Processing
                                </span>
                            @elseif($order->status == 2)
                                <span class="badge badge-pill badge-soft-success font-size-14">
                                    Packing
                                </span>
                            @elseif($order->status == 3)
                                <span class="badge badge-pill badge-soft-warning font-size-14">
                                    Delivering
                                </span>
                            @elseif($order->status == 4)
                                <span class="badge badge-pill badge-soft-success font-size-14">
                                    Complete
                                </span>
                            @elseif($order->status == 6)
                                <span class="badge badge-pill badge-soft-danger font-size-14">
                                    Rejected
                                </span>
                            @elseif($order->status == 9)
                                <span class="badge badge-pill badge-soft-danger font-size-14">
                                    Pending payment
                                </span>
                            @else
                                <span class="badge badge-pill badge-soft-danger font-size-12">
                                    Pending Refund
                                </span>
                            @endif
                        </span>
                    </p>
                    <p class="mb-4">Remark: <span class="text-primary" id="receiver-name">{{ $order->remarks }}</span></p>
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
                    <div class="modal-footer">
                        <form action="{{ route('packing', $order->id)}}" method="POST" id="status-form-{{ $order->id }}">
                            @csrf
                            <div class="edit-mode" style="display: none;">
                                <p class="mb-2">Change Status:</p>
                                <select class="form-select mb-3" name="status">
                                    <option value="2">Packing</option>
                                    <option value="3">Delivering</option>
                                    <option value="4">Complete</option>
                                    <option value="6">Rejected</option>
                                    <option value="9">Pending payment</option>
                                </select>
                            </div>
                            @if($order->status == 6 )
                                <button type="button" class="btn btn-secondary btn-edit" disabled>Update Status</button>
                            @elseif($order->status == 4 )
                                <button type="button" class="btn btn-secondary btn-edit" disabled>Update Status</button>
                            @else
                                <input type="hidden" name="remark" id="remark-{{ $order->id }}">
                                <button type="button" class="btn btn-success btn-edit" data-order-id-edit="{{ $order->id }}" data-order-status-edit="{{ $order->status }}">Update Status</button>
                            @endif
                        </form>
                        
                    </div>
                </div>
        </div>
    </div>
</div>


