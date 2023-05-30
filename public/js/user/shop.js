$(document).ready(function () {
    // routes
    const ajaxIndexUrl = window.routes.ajaxIndexUrl;
    const getProductsUrl = window.routes.getProductsUrl;

    // product detail page
    $('.detail-view').on('click', function () {
        $id = $(this).data('id');

        window.location.href = '/products/' + $id + '/details';
    })

    $('#sorting').change(function () {
        $option = $('#sorting').val();

        if ($option == 'asc') {
            axios.post(ajaxIndexUrl, { status: 'asc' })
                .then(res => {
                    $list = '';
                    for ($i = 0; $i < res.data.length; $i++) {
                        $list += `
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="product__item" id="myForm">
                                        <div class="product__item__pic set-bg detail-view" data-product-id="${res.data[$i].id}"
                                            data-setbg="/storage/${res.data[$i].image}">
                                            <div class="product__label">
                                                <span>${res.data[$i].category.name}</span>
                                            </div>
                                        </div>
                                        <div class="product__item__text">
                                            <h6><a href="#">${res.data[$i].name}</a></h6>
                                            <div class="product__item__price">${res.data[$i].price} MMK</div>
                                            <div class="cart_add" data-id="${res.data[$i].id}" data-name="${res.data[$i].name}"
                                                data-price="${res.data[$i].price}" data-image="${res.data[$i].image}"
                                                data-quantity="1">
                                                <a href="#" class="add-to-cart-btn">Add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                    }
                    $('#dataList').html($list);
                    $('#product-pagination').remove();

                    // After appending the list, apply the background images
                    $('.set-bg').each(function () {
                        let imgUrl = $(this).data('setbg');
                        $(this).css('background-image', 'url(' + imgUrl + ')');
                    });
                })
                .catch(err => {
                    console.log(err);
                })
        } else if ($option == 'desc') {
            axios.post(ajaxIndexUrl, { status: 'desc' })
                .then(res => {
                    $list = '';
                    for ($i = 0; $i < res.data.length; $i++) {
                        $list += `
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="product__item" id="myForm">
                                    <div class="product__item__pic set-bg detail-view" data-product-id="${res.data[$i].id}"
                                        data-setbg="/storage/${res.data[$i].image}">
                                        <div class="product__label">
                                            <span>${res.data[$i].category.name}</span>
                                        </div>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="#">${res.data[$i].name}</a></h6>
                                        <div class="product__item__price">${res.data[$i].price} MMK</div>
                                        <div class="cart_add" data-id="${res.data[$i].id}" data-name="${res.data[$i].name}"
                                            data-price="${res.data[$i].price}" data-image="${res.data[$i].image}"
                                            data-quantity="1">
                                            <a href="#" class="add-to-cart-btn">Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    }
                    $('#dataList').html($list);
                    $('#product-pagination').remove();

                    // After appending the list, apply the background images
                    $('.set-bg').each(function () {
                        let imgUrl = $(this).data('setbg');
                        $(this).css('background-image', 'url(' + imgUrl + ')');
                    });
                })
                .catch(err => {
                    console.log(err);
                })
        }
    })

    // Filtering by category\
    $('#filterByCategory').on('change', function (e) {
        e.preventDefault();

        $categoryId = $(this).val();
        const filterProductsUrl = window.routes.filterProductsUrl.replace('__id__', $categoryId);

        if ($categoryId == 'all') {
            axios.get(getProductsUrl)
                .then(res => {
                    $('#dataList').empty();
                    res.data.forEach(product => {
                        $('#dataList').append(`
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="product__item" id="myForm">
                                        <div class="product__item__pic set-bg detail-view" data-id="${product.id}"
                                            data-setbg="/storage/${product.image}" style="cursor: pointer">
                                            <div class="product__label">
                                                <span>
                                                    ${product.category.name}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="product__item__text">
                                            <h6><a href="#">${product.name}</a></h6>
                                            <div class="product__item__price">${product.price} MMK</div>
                                            <div class="cart_add" data-id="${product.id}" data-name="${product.name}"
                                                data-price="${product.price}" data-image="${product.image}"
                                                data-quantity="1">
                                                <a href="#" class="add-to-cart-btn">Add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `);
                    })
                    $('#product-pagination').remove();
                    // After appending the list, apply the background images
                    $('.set-bg').each(function () {
                        let imgUrl = $(this).data('setbg');
                        $(this).css('background-image', 'url(' + imgUrl + ')');
                    });
                })
                .catch(err => {
                    console.log(err);
                })
        } else {
            axios.get(filterProductsUrl)
                .then(res => {
                    $('#dataList').empty();
                    if (res.data.length > 0) {
                        res.data.forEach(product => {
                            $('#dataList').append(`
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="product__item" id="myForm">
                                    <div class="product__item__pic set-bg detail-view" data-id="${product.id}"
                                        data-setbg="/storage/${product.image}" style="cursor: pointer">
                                        <div class="product__label">
                                            <span>
                                                ${product.category.name}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="#">${product.name}</a></h6>
                                        <div class="product__item__price">${product.price} MMK</div>
                                        <div class="cart_add" data-id="${product.id}" data-name="${product.name}"
                                            data-price="${product.price}" data-image="${product.image}"
                                            data-quantity="1">
                                            <a href="#" class="add-to-cart-btn">Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `);
                        })
                        $('#product-pagination').remove();
                    } else {
                        $('#dataList').append(`
                            <h3 class="text-center mx-auto py-5 my-5">Product not Found Sorry!</h3>
                        `);
                        $('#product-pagination').remove();
                    }
                    // After appending the list, apply the background images
                    $('.set-bg').each(function () {
                        let imgUrl = $(this).data('setbg');
                        $(this).css('background-image', 'url(' + imgUrl + ')');
                    });
                })
                .catch(err => {
                    console.log(err);
                })
        }
    })
})