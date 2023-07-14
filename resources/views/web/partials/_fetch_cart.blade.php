<script>
    $('cart-button').click(function (e) {
        e.preventDefault();

    });

    function fetchCartRecords() {
        fetch('/cart/records', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(function(response) {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Error fetching cart records');
            }
        })
        .then(function(data) {
            // Generate the HTML structure for each cart item
            var html = '';
            data.forEach(function(item) {
                html += '<a href="" class="text-reset notification-item">';
                html += '<div class="d-flex border-bottom align-items-start">';
                html += '<div class="flex-shrink-0">';
                html += '<img src="' + item.image + '" class="me-3 rounded-circle avatar-sm" alt="user-pic">';
                html += '</div>';
                html += '<div class="flex-grow-1">';
                html += '<h6 class="mb-1">' + item.name + '</h6>';
                html += '<div class="text-muted">';
                html += '<p class="mb-1 font-size-13">' + item.price + '</p>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '</a>';
            });

            // Update the HTML container with the generated HTML
            document.getElementById('ajax-data').innerHTML = html;
        })
        .catch(function(error) {
            console.log(error);
        });
        console.log($data);
        console.log($item);
    }


</script>
