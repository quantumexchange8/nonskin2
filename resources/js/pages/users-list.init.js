/*
Template Name: Symox - Admin & Dashboard Template
Author: Themesbrand
Website: https://Themesbrand.com/
Contact: Themesbrand@gmail.com
File: Ecommerce order Js File
*/

// Basic Table
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
                name: 'Name',
                formatter: (function (cell) {
                    return gridjs.html('<img src="assets/images/users/' + cell[0] + '" alt="" class="avatar-sm rounded-circle me-2" /><a href="#" class="text-body">' + cell[1] + "</a>");
                })
            },

            "Position", "Email",
            {
                name: "View Details",
                sort: {
                    enabled: false
                },
                formatter: (function (cell) {
                    return gridjs.html('<ul class="list-inline mb-0">' +
                        '<li class="list-inline-item">' +
                        '<a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" class="px-2 text-primary"><i class="bx bx-pencil font-size-18"></i></a>' +
                        ' </li>' +
                        ' <li class="list-inline-item">' +
                        ' <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="px-2 text-danger"><i class="bx bx-trash-alt font-size-18"></i></a>' +
                        '</li>' +
                        ' <li class="list-inline-item dropdown">' +
                        '<a class="text-muted dropdown-toggle font-size-18 px-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">' +
                        ' <i class="bx bx-dots-vertical-rounded"></i>' +
                        ' </a>' +
                        ' <div class="dropdown-menu dropdown-menu-end">' +
                        ' <a class="dropdown-item" href="#">Action</a>' +
                        '  <a class="dropdown-item" href="#">Another action</a>' +
                        '   <a class="dropdown-item" href="#">Something else here</a>' +
                        ' </div>' +
                        ' </li>' +
                        ' </ul>');
                })
            }
        ],
    pagination: {
        limit: 10
    },
    sort: true,
    search: true,
    data: [
        ["", ["avatar-1.jpg", "Simon Ryles"], "Chief Distributor", "SimonRyles@symox.com", "$400", "Paid", "Mastercard", "View Details"],
        ["", ["avatar-2.jpg", "Marion Walker"], "Exclusive Distributor", "MarionWalker@symox.com", "$452", "Chargeback", "Visa", "View Details"],
        ["", ["avatar-3.jpg", " Marion Walker"], "General Distributor", "FrederickWhite@symox.com", "$632", "Refund", "Paypal", "View Details"],
        ["", ["avatar-4.jpg", " Shanon Marvin"], "Member", "ShanonMarvin@symox.com", "$521", "Refund", "COD", "View Details"],
        ["", ["avatar-5.jpg", "Mark Jones"], "Exclusive Distributor", "MarkJones@symox.com", "$521", "Paid", "Mastercard", "View Details"],
        ["", ["avatar-6.jpg", " Janice Morgan"], "Member", "JaniceMorgan@symox.com", "$365", "Chargeback", "Visa", "View Details"],
        ["", ["avatar-7.jpg", "Patrick Petty"], "General Distributor", "PatrickPetty@symox.com", "$452", "Paid", "Paypal", "View Details"],
        ["", ["avatar-8.jpg", " Marilyn Horton"], "Member", "MarilynHorton@symox.com", "$365", "Paid", "COD", "View Details"],
        ["", ["avatar-9.jpg", "Neal Womack"], "Chief Distributor", "NealWomack@symox.com", "$254", "Refund", "COD", "View Details"],
        ["", ["avatar-10.jpg", "Steven Williams"], "Exclusive Distributor", "StevenWilliams@symox.com", "$400", "Paid", "Mastercard", "View Details"],
        ["", ["avatar-1.jpg", "Stacie Parker"], "Chief Distributor", "StacieParker@symox.com", "$400", "Paid", "Mastercard", "View Details"],
        ["", ["avatar-2.jpg", "Betty Wilson"], "Exclusive Distributor", "BettyWilson@symox.com", "$452", "Chargeback", "Visa", "View Details"],
        ["", ["avatar-3.jpg", "Roman Crabtree"], "General Distributor", "RomanCrabtree@symox.com", "$632", "Refund", "Paypal", "View Details"],
        ["", ["avatar-4.jpg", "Marisela Butler"], "Member", "MariselaButler@symox.com", "$521", "Refund", "COD", "View Details"],
        ["", ["avatar-5.jpg", "Roger Slayton"], "Exclusive Distributor", "RogerSlayton@symox.com", "$521", "Paid", "Mastercard", "View Details"],
        ["", ["avatar-6.jpg", "Barbara Torres"], "Member", "BarbaraTorres@symox.com", "$365", "Chargeback", "Visa", "View Details"],
        ["", ["avatar-7.jpg", "Daniel Rigney"], "General Distributor", "DanielRigney@symox.com", "$452", "Paid", "Paypal", "View Details"],
        ["", ["avatar-8.jpg", "Kenneth Linck"], "Member", "KennethLinck@symox.com", "$365", "Paid", "COD", "View Details"],
        ["", ["avatar-9.jpg", "Felix Perry"], "Chief Distributor", "FelixPerry@symox.com", "$254", "Refund", "COD", "View Details"],
        ["", ["avatar-10.jpg", "Willie Verner"], "Exclusive Distributor", "WillieVerner@symox.com", "$400", "Paid", "Mastercard", "View Details"],
    ]
}).render(document.getElementById("table-users-list"));

flatpickr('#order-date', {
    maxDate: "today"
});
