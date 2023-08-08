<div class="tab-pane fade" id="v-pills-addresses" role="tabpanel" aria-labelledby="v-pills-addresses-tab">
    <div class="row p-2">
        <div class="d-flex justify-content-between">
            <h5 class="font-size-16">My Addresses:</h5>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addNewAddress"><i class="bx bx-plus-circle"></i> Add New Address</button>
        </div>
    </div>
    @foreach (Auth::user()->address as $address)
        <hr>
        <div class="row">
            <div class="col-sm-6 p-3">
                <div class="text-muted">
                    <h5 class="font-size-15 mb-2">{{ $address->name }}</h5>
                    <span>{{ $address->contact }}</span>
                    <p class="mb-1">{{ $address->address_1 }} {{ $address->address_2 }}</p>
                    <p class="mb-1">{{ $address->postcode }}, {{ $address->city }}, {{ $address->state }}, {{ $address->country }}</p>
                    @if ($address->is_default == 1)
                        <h5 class="font-size-15 mb-1"><span class="badge badge-soft-warning font-size-12">Default</span></h5>
                    @endif
                </div>
            </div>
            <div class="col-sm-6 p-3">
                <div class="text-muted text-sm-end">
                    <a class="link" role="button" data-bs-toggle="modal" data-bs-target="#editAddressModal{{ $address->id }}">Edit</a>
                    <br>
                    @if ($address->is_default == 0)
                    <form action="" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-soft-primary btn-sm border mt-2">Set As Default</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
