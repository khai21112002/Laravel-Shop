// to get current year
function getYear() {
    var currentDate = new Date();
    var currentYear = currentDate.getFullYear();
    document.querySelector("#displayYear").innerHTML = currentYear;
}

getYear();


// client section owl carousel
$(".client_owl-carousel").owlCarousel({
    loop: true,
    margin: 0,
    dots: false,
    nav: true,
    navText: [],
    autoplay: true,
    autoplayHoverPause: true,
    navText: [
        '<i class="fa fa-angle-left" aria-hidden="true"></i>',
        '<i class="fa fa-angle-right" aria-hidden="true"></i>'
    ],
    responsive: {
        0: {
            items: 1
        },
        768: {
            items: 2
        },
        1000: {
            items: 2
        }
    }
});



/** google_map js **/
function myMap() {
    var mapProp = {
        center: new google.maps.LatLng(40.712775, -74.005973),
        zoom: 18,
    };
    var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
}
function isActive(button) {
    // Lấy tất cả các nút trong navproduct
    var buttons = document.querySelectorAll('.navproduct button',);
    // Xóa class 'active' khỏi tất cả các nút
    buttons.forEach(btn => btn.classList.remove('active'));
    // Thêm class 'active' vào nút được nhấn
    button.classList.add('active'); // Sử dụng tham số 'button' truyền vào
}
// Xử lý dữ liệu product_by_category


function selectCategoryHome(element) {
    var categoryIdHome = $(element).data('category');

    $.ajax({
        url: '/',  // Sử dụng biến chứa URL
        method: 'GET',
        data: {
            categoryIdHome: categoryIdHome
        },
        success: function (response) {

            $('.product-list').html(response);  // Cập nhật lại sản phẩm
        },
        error: function (xhr) {
            console.error(xhr.responseText);
        }
    });
}

function selectCategoryProduct(element) {
    var categoryIdProduct = $(element).data('category');

    $.ajax({
        url: '/product',  // Sử dụng biến chứa URL
        method: 'GET',
        data: {
            categoryIdProduct: categoryIdProduct
        },
        success: function (response) {

            $('.product-list').html(response);  // Cập nhật lại sản phẩm
        },
        error: function (xhr) {
            console.error(xhr.responseText);
        }
    });
}
function searchProductsHome() {
    var searchTermHome = $('#search_input').val();
    $.ajax({
        url: '/',
        method: 'GET',
        data: {
            searchHome: searchTermHome
        },
        success: function(response) {
            $('.product-list').html(response);
        },
        error: function(xhr) {
            console.error(xhr.responseText);
        }
    });
}
function searchProductsProduct() {
    var searchTermProduct = $('#search_input').val();
    $.ajax({
        url: '/product',
        method: 'GET',
        data: {
            searchProduct: searchTermProduct
        },
        success: function(response) {
            $('.product-list').html(response);
        },
        error: function(xhr) {
            console.error(xhr.responseText);
        }
    });
}
function searchOrder(){
    var searchTermOrder=$('#search_input').val();
    $.ajax({
        url:'/order',
        method:'GET',
        data:{
            searchOrder:searchTermOrder
        },
        success: function(response) {
            $('.order-list').html(response);
        },
        error: function(xhr) {
            console.error(xhr.responseText);
        }
    })
}

