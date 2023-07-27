new gridjs.Grid({
    columns:
        [
            {
                name: '#',
                sort: {
                    enabled: false
                },
                formatter: (function (cell) {
                    return gridjs.html('<div class="form-check font-size-16"><input class="form-check-input" type="checkbox" id="orderidcheck01"><label class="form-check-label" for="orderidcheck01"></label></div>');
                })
            },
            {
                name: 'Order ID',
                formatter: (function (cell) {
                    return gridjs.html('<span class="fw-semibold">' + cell + '</span>');
                })
            },
            "Billing Name", "Date", "Total",
            {
                name: 'Payment Status',
                formatter: (function (cell) {
                    switch (cell) {
                        case "Paid":
                            return gridjs.html('<span class="badge badge-pill badge-soft-success font-size-12">' + cell + '</span>');

                        case "Chargeback":
                            return gridjs.html('<span class="badge badge-pill badge-soft-danger font-size-12">' + cell + '</span>');

                        case "Refund":
                            return gridjs.html('<span class="badge badge-pill badge-soft-warning font-size-12">' + cell + '</span>');

                        default:
                            return gridjs.html('<span class="badge badge-pill badge-soft-success font-size-12">' + cell + '</span>');
                    }
                })
            },
            {
                name: "Payment Method",
                formatter: (function (cell) {
                    switch (cell) {
                        case "Mastercard":
                            return gridjs.html('<i class="fab fa-cc-mastercard me-2"></i>' + cell);
                        case "Visa":
                            return gridjs.html('<i class="fab fa-cc-visa me-2"></i>' + cell);
                        case "Paypal":
                            return gridjs.html('<i class="fab fa-cc-paypal me-2"></i>' + cell);
                        case "COD":
                            return gridjs.html('<i class="fas fa-money-bill-alt me-2"></i>' + cell);
                    }
                })
            },
            {
                name: "View Details",
                formatter: (function (cell) {
                    return gridjs.html('<button type="button" class="btn btn-primary btn-sm btn-rounded" data-bs-toggle="modal" data-bs-target=".orderdetailsModal">' + cell + '</button>');
                })
            },
            {
                name: "Action",
                sort: {
                    enabled: false
                },
                formatter: (function (cell) {
                    return gridjs.html('<div class="d-flex gap-3"><a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" class="text-success"><i class="mdi mdi-pencil font-size-18"></i></a><a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="text-danger"><i class="mdi mdi-delete font-size-18"></i></a></div>');
                })
            }
        ],
    pagination: {
        limit: 8
    },
    sort: true,
    search: true,
    server: {
        url: '{{ route("admin.new-order-gridData") }}',
    }
}).render(document.getElementById("table-new-orders"));

flatpickr('#order-date', {
    defaultDate: new Date(),
    dateFormat: "d M, Y",
});
