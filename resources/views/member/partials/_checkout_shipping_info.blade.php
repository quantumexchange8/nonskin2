<a href="#checkout-shippinginfo-collapse" class="collapsed text-dark" data-bs-toggle="collapse">
    <div class="p-4">
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0 me-3">
                <i class="bx bxs-truck text-primary h2"></i>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <h5 class="font-size-16 mb-1">Shipping Info</h5>
                <p class="text-muted text-truncate mb-0">Please confirm your delivery address</p>
            </div>
            <div class="flex-shrink-0">
                <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
            </div>
        </div>
    </div>
</a>

<div id="checkout-shippinginfo-collapse" class="collapse show">
    <div class="p-4 border-top">
        <div style="display: flex;justify-content: space-between;">
            <div>
                <h5 class="font-size-14 mb-3">Shipping Info</h5>
            </div>
            <div>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addNewAddress"><i class="bx bx-plus-circle"></i> Add New Address</button>
            </div>
        </div>
        
        <div class="row">
            @foreach ($shipping_address as $k => $v)
            <div class="col-lg-4 col-sm-6">
                <div>
                    <label class="card-radio-label mb-0">
                        <input type="radio" name="address" id="address{{ $v->id }}" onchange="updateShippingCharge(this)" class="card-radio-input" data-name="{{ $v->name }}"
                            data-contact="{{ $v->contact }}" data-shipping-charge="{{ $v->shippingCharge->amount }}"
                            value="{{ $v->address_1 }}, {{ $v->address_2 }}, {{ $v->postcode }}, {{ $v->city }}, {{ $v->state }}, {{ $v->country }}">

                        <div class="card-radio text-truncate p-3">
                            <span class="fs-14 mb-2 d-block">
                                {{ $v->name }}
                                
                            </span>
                            <span class="text-muted fw-normal text-wrap mb-1 d-block">
                                {{ $v->address_1 }}, {{ $v->address_2 }}, {{ $v->postcode }}, {{ $v->city }}, {{ $v->state }}, {{ $v->country }}
                            </span>
                            <span class="text-muted fw-normal d-block">Contact: {{ $v->contact }}</span>
                        </div>
                    </label>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>