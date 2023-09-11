<div class="modal fade" id="orderdetailsModal_{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="orderdetailsModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderdetailsModalLabel">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <a href="{{ route('invoice-admin', $order->id) }}" target="_blank">
                        <button class="btn btn-success">
                            Print
                        </button>
                    </a>
                </div>
            <form action="{{ route('orders.packing', $order->id)}}" method="POST" id="status-form-{{ $order->id }}">
                @csrf
                <div class="modal-body">
                    <p class="mb-2">Order Id: <span class="text-primary" id="order-id">{{$order->order_num}}</span></p>
                    <p class="mb-2">Customer Name: <span class="text-primary">{{$order->receiver}}</span></p>
                    @if($order->delivery_method == 'Self-Pickup')
                    <p class="mb-2">Delivery Method: <span class="text-primary" >{{$order->delivery_method}}</span></p>
                    <p class="mb-4">Self-Pickup Address: <span class="text-primary" >{{$order->delivery_address}}</span></p>
                    @else
                    <p class="mb-2">Deliver Method: <span class="text-primary" >{{$order->delivery_method}}</span></p>
                    <p class="mb-2">Deliver Address: <span class="text-primary" >{{$order->delivery_address}}</span></p>
                    @endif
                    @if($order->delivery_method == 'Self-Pickup')
                    <div class="mb-2" id="status-section-{{ $order->id }}">
                        <label class="mb-2">Status:</label>
                        @if ($order->status == 1)
                            <span class="text-primary" >Processing</span>
                        @elseif ($order->status == 2)
                            <span class="text-primary">Packing</span>
                        @elseif ($order->status == 4)
                            <span class="text-primary">Complete</span>
                        @elseif ($order->status == 5)
                            <span class="text-primary">Cancel</span>
                        @elseif ($order->status == 6)
                            <span class="text-primary">Rejected</span>
                        @elseif ($order->status == 6)
                            <span class="text-primary">Unpaid</span>
                        @endif
                        <select class="form-control d-none" name="status">
                            <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Processing</option>
                            <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Packing</option>
                            <option value="4" {{ $order->status == 4 ? 'selected' : '' }}>Complete</option>
                            <option value="5" {{ $order->status == 5 ? 'selected' : '' }}>Cancel</option>
                            <option value="9" {{ $order->status == 5 ? 'selected' : '' }}>Unpaid</option>
                        </select>
                    </div>
                    @else
                    <div class="mb-2" id="status-section-{{ $order->id }}">
                        <label class="mb-2">Status:</label>
                        @if ($order->status == 1)
                            <span class="text-primary" >Processing</span>
                        @elseif ($order->status == 2)
                            <span class="text-primary">Packing</span>
                        @elseif ($order->status == 3)
                            <span class="text-primary">Delivering</span>
                        @elseif ($order->status == 4)
                            <span class="text-primary">Complete</span>
                        @elseif ($order->status == 5)
                            <span class="text-primary">Cancel</span>
                        @elseif ($order->status == 6)
                            <span class="text-primary">Rejected</span>
                        @endif
                        <select class="form-control d-none" name="status">
                            <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Processing</option>
                            <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Packing</option>
                            <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>Delivering</option>
                            <option value="4" {{ $order->status == 4 ? 'selected' : '' }}>Complete</option>
                            <option value="5" {{ $order->status == 5 ? 'selected' : '' }}>Cancel</option>
                        </select>
                    </div>
                    @endif
                    
                    <div class="mb-2" id="courier-section">
                        <label class="mb-2">Courier:</label>
                        <span class="text-primary" >{{$order->courier}}</span>
                        <input type="text" class="form-control d-none" value="{{$order->courier}}" name="courier">
                    </div>

                    {{-- <div class="mb-2" id="consignment-section">
                        <label class="mb-2">Consignment Note:</label>
                        <span class="text-primary" >{{$order->cn}}</span>
                        <input type="text" class="form-control d-none" value="{{$order->cn}}" name="cn">
                    </div> --}}

                    <div class="mb-2" id="tracking-section">
                        <label class="mb-2">Tracking Number:</label>
                        <span class="text-primary" >{{$order->tracking_number}}</span>
                        <input type="text" class="form-control d-none" value="{{$order->tracking_number}}" name="tracking_number">

                    </div>


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
                                        <h6 class="m-0 text-right">Total Discount:</h6>
                                    </td>
                                    <td>
                                       - RM {{ number_format($order->discount_amt, 2)}}
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
                                        <h6 class="m-0 text-right">Total Payment:</h6>
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
                    @if($order->status == 6 )
                        <button type="button" class="btn btn-secondary btn-edit" disabled>Update Status</button>
                    @elseif($order->status == 4 )
                        <button type="button" class="btn btn-secondary btn-edit" disabled>Update Status</button>
                    @else
                        <input type="hidden" name="remark" id="remark-{{ $order->id }}">

                        <button type="button" class="btn btn-success btn-edit"
                            data-order-edit="{{ $order->id }}"
                            data-order-status="{{ $order->status }}"
                            data-order-shipment="{{ $order->delivery_method }}"
                            >Edit</button>
                        <button type="button" class="btn btn-danger btn-close-modal" data-bs-dismiss="modal" aria-label="Close">Close</button>

                        <button type="submit" class="btn btn-success btn-save-profile d-none" data-order-id="{{ $order->id }}" id="save-profile-button">Save</button>
                        <button type="button" class="btn btn-danger btn-cancel-edit d-none" data-order-id="{{ $order->id }}" id="cancel-edit-button" data-bs-dismiss="modal">Cancel</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>


