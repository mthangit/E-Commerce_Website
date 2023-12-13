const currencySymbol = "₫";

// Chọn variant nào thì sẽ hiển thị giá của variant đó và mô tả của variant
const variant = document.querySelectorAll('.variant');
const variantDescription = document.querySelectorAll('.variant-description');
const originalPrice = document.querySelectorAll('.real-price');
const discountedPrice = document.querySelectorAll('.discounted-price');

// Mặc định để thông tin của variant có mức giá cao nhất
variantDescription[0].innerHTML = "60ml";
discountedPrice[0].textContent = "350.000 " + currencySymbol;
originalPrice[0].textContent = "700.000 " + currencySymbol;

variant.forEach(item => {
    item.addEventListener('click', () => {
        variant.forEach(variant => {
            variant.classList.remove('selected');
        });

        // Add the 'selected' class to the clicked product item
        item.classList.add('selected');
        var newPrice = addDotsToNumber(item.getAttribute('data-new-price'))
        var oldPrice = addDotsToNumber(item.getAttribute('data-old-price'))
        variantDescription[0].innerHTML = item.innerHTML
        discountedPrice[0].textContent = newPrice + " " + currencySymbol
        originalPrice[0].textContent = oldPrice + " " + currencySymbol
    });
});

function addDotsToNumber(number) {
    const numberString = number.toString(); // Chuyển số thành chuỗi
    const parts = numberString.split('.'); // Tách phần nguyên và phần thập phân (nếu có)

    let integerPart = parts[0]; // Phần nguyên

    // Thêm dấu chấm sau mỗi 3 chữ số từ phải sang trái
    integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

    // Kết hợp phần nguyên và phần thập phân (nếu có)
    let formattedNumber = integerPart;
    if (parts[1]) {
        formattedNumber += '.' + parts[1];
    }

    return formattedNumber;
}


// Khi nhấn vào câu hỏi thì mới hiện ra câu trả lời
function toggleAnswer(x){
    var answer = document.querySelector('.question-'+x+'-answer')
    var questionIcon = document.querySelector('.question-'+x+'-title i')
    if (answer.style.display === "block") {
        answer.style.display = "none";
        questionIcon.className = "fa-solid fa-angle-down right"
    } else {
        answer.style.display = "block";
        questionIcon.className = "fa-solid fa-angle-up right"
    }
}

function togglePassword(num) {
    var x = document.querySelector(".password-hide-"+num);
    var eyeIcon = document.querySelector(".reveal-pass-"+num);
    if (x.type === "password") {
        x.type = "text";
        eyeIcon.className = "fa-regular fa-eye-slash txt-cyan reveal-pass"
    } else {
        x.type = "password";
        eyeIcon.className = "fa-regular fa-eye txt-cyan reveal-pass"
    }
}
document.addEventListener('DOMContentLoaded', function() {
    // Bắt sự kiện khi giá trị của dropdown chọn thay đổi
    document.getElementById('sort-select').addEventListener('change', function() {
        // Lấy giá trị được chọn
        var selectedValue = this.value;

        // Sắp xếp lại các sản phẩm trên trang hiện tại
        sortProducts(selectedValue);
    });

    // Hàm sắp xếp lại sản phẩm trên trang hiện tại
    function sortProducts(sortBy) {
        var productList = document.querySelector('.product-list-content');
        var products = Array.from(productList.getElementsByClassName('preview-product'));

        products.sort(function(a, b) {
            if (sortBy === 'Increase' || sortBy === 'Decrease') {
                var aPrice = parseFloat(a.querySelector('.discount-price').textContent.replace('₫', '').replace(',', ''));
                var bPrice = parseFloat(b.querySelector('.discount-price').textContent.replace('₫', '').replace(',', ''));

                return sortBy === 'Increase' ? aPrice - bPrice : bPrice - aPrice;
            } else if (sortBy === 'Alphabet') {
                var aValue = a.querySelector('.product-name').textContent.toLowerCase();
                var bValue = b.querySelector('.product-name').textContent.toLowerCase();
                return aValue.localeCompare(bValue);
            }
        });

        // Xóa các sản phẩm hiện tại
        productList.innerHTML = '';

        // Thêm lại sản phẩm đã được sắp xếp
        products.forEach(function(product) {
            productList.appendChild(product);
        });
    }
});



