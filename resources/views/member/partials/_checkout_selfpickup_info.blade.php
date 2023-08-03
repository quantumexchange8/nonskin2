<a href="#checkout-selfpickupinfo-collapse" class="collapsed text-dark" data-bs-toggle="collapse">
    <div class="p-4">
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0 me-3">
                <i class="bx bxs-truck text-primary h2"></i>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <h5 class="font-size-16 mb-1">Self-Pickup Info</h5>
            </div>
            <div class="flex-shrink-0">
                <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
            </div>
        </div>
    </div>
</a>

<div id="checkout-selfpickupinfo-collapse" class="collapse show">
    <div class="p-4 border-top">
        <h5 class="font-size-14 mb-3">Company Info</h5>
        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <div>
                    <label class="card-radio-label mb-0">
                        <input type="radio" name="address" id="address"
                            class="card-radio-input" data-name="{{ $default_address }}" data-contact="{{ $default_address->contact }}"
                            value="{{ $default_address->address_1 }}, {{ $default_address->address_2 }}, {{ $default_address->postcode }}, {{ $default_address->city }}, {{ $default_address->state }}, {{ $default_address->country }}">
                        <div class="card-radio text-truncate p-3">
                            
                            <span class="fs-14 mb-2 d-block">
                                Company
                                
                            </span>
                            <span class="text-muted fw-normal text-wrap mb-1 d-block">
                                {{ $default_address->address_1 }}, {{ $default_address->address_2 }}, {{ $default_address->postcode }}, {{ $default_address->city }}, {{ $default_address->state }}, {{ $default_address->country }}
                            </span>
                            <span class="text-muted fw-normal d-block">Contact: {{ $default_address->contact }}</span>
                        </div>
                    </label>
                </div>
            </div>
            
        </div>
    </div>
</div>