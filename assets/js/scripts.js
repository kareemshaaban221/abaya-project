function login(e) {
    console.log('trest');
    e.preventDefault();
    const data = new FormData(e.target);
    if (data.get('user_type') == 'user')
        e.target.action = '../user/index.html';
    else if (data.get('user_type') == 'designer')
        e.target.action = '../designer/index.html';
    else {
        alert('هناك شئ خاطئ!');
        return;
    }
    e.target.submit();
}

const loginForm = document.getElementById('login-form');
if (loginForm)
    loginForm.addEventListener('submit', login);

function getSwiperInstance(swiper_selector) {
    return new Swiper(swiper_selector, {
        // Optional parameters
        direction: 'horizontal',

        // If we need pagination
        pagination: {
            el: '.swiper-pagination',
        },

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        autoplay: {
            delay: 2000,
        },

        slidesPerView: 4,
        // loop: true,
        // allowTouchMove: false,
    });
}

swiper = getSwiperInstance('#swiper1');
swiper2 = getSwiperInstance('#swiper2');

function filterProducts(filter_element, swiper_exists = true) {
    swiper_exists ? swiper.destroy(true, true) : null;

    var products = document.getElementsByClassName('product-container');
    var filter = filter_element.value;
    for (var i = 0, product; i < products.length; i++) {
        product = products[i];
        if (filter != 'all')
            if (product.hasAttribute(filter)) {
                product.classList.remove('d-none');
                product.classList.add('swiper-slide');
            } else {
                product.classList.add('d-none');
                product.classList.remove('swiper-slide');
            }
        else {
            product.classList.remove('d-none');
            product.classList.add('swiper-slide');
        }
    }

    if (swiper_exists)
        swiper = getSwiperInstance('#swiper1');
}

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

const dataTable = new DataTable('#dataTable');

function deleteParentRow(e) {
    e.parentElement.parentElement.remove();
    var tooltips = document.getElementsByClassName('tooltip');
    for (var i = 0; i < tooltips.length; i++)
        tooltips[i].remove();
    calculateAmount();
}

function amountIncrement(e) {
    var amountContainer = e.nextElementSibling;
    amountContainer.innerText = parseInt(amountContainer.innerText) + 1;
    calculateAmount();
}

function amountDecrement(e) {
    var amountContainer = e.previousElementSibling;
    if (parseInt(amountContainer.innerText) <= 1)
        alert('Quantity is out of range.');
    else
        amountContainer.innerText = parseInt(amountContainer.innerText) - 1;
    calculateAmount();
}

function calculateAmount() {
    var itemPrices =  document.getElementsByClassName('item-price');
    var itemAmounts = document.getElementsByClassName('item-amount');
    var priceContainer = document.getElementById('price');
    var priceInput = document.getElementById('price-input');
    var totalPrice = 0;
    for (var i = 0; i < itemPrices.length; i++) {
        totalPrice += parseInt(itemPrices[i].innerText) * parseInt(itemAmounts[i].innerText);
    }
    priceContainer.innerText = totalPrice;
    priceInput.value = totalPrice;
}

if (document.getElementById('price'))
    calculateAmount();
