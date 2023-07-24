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
        <h5 class="font-size-14 mb-3">Shipping Info</h5>
        <div class="row">
            @foreach ($user->address as $k => $v)
            <div class="col-lg-4 col-sm-6">
                <div>
                    <label class="card-radio-label mb-0">
                        <input type="radio" name="address" id="info-address"
                            class="card-radio-input" {{ $v->is_default == 1 ? 'checked' : '' }}
                            value="{{ $v->address_1 }}, {{ $v->address_2 }}, {{ $v->postcode }}, {{ $v->city }}, {{ $v->state }}, {{ $v->country }}">
                        <div class="card-radio text-truncate p-3">
                            {{-- <span class="fs-14 mb-4 d-block">Delivery Address</span> --}}
                            <span class="fs-14 mb-2 d-block">
                                {{ $v->name }}
                                @if ($v->is_default == 1)
                                    <span class="fw-normal btn btn-sm btn-warning">Default</span>
                                @endif
                            </span>
                            <span class="text-muted fw-normal text-wrap mb-1 d-block">
                                {{ $v->address_1 }}, {{ $v->address_2 }}, {{ $v->postcode }}, {{ $v->city }}, {{ $v->state }}, {{ $v->country }}
                            </span>
                            <span class="text-muted fw-normal d-block">Contact: {{ $v->contact }}</span>
                        </div>
                    </label>
                    <div class="edit-btn bg-light  rounded">
                        <a href="#" data-bs-toggle="tooltip" data-placement="top"
                            title="" data-bs-original-title="Edit">
                            <i class="bx bx-pencil font-size-16"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
