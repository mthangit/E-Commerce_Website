// Chọn variant nào thì sẽ hiển thị giá của variant đó và mô tả của variant
const variant = document.querySelectorAll('.variant')
const variantDescription = document.querySelectorAll('.variant-description')
const originalPrice = document.querySelectorAll('.real-price')
const discountedPrice = document.querySelectorAll('.discounted-price')

// Mặc định để thông tin của variant có mức giá cao nhất
variantDescription[0].innerHTML = "60ml"
discountedPrice[0].textContent = "350.000 đ"
originalPrice[0].textContent = "700.000 đ"

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
        discountedPrice[0].textContent = newPrice + " đ"
        originalPrice[0].textContent = oldPrice + " đ"
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

// Hover ảnh cover của home thì sẽ đổi ảnh khác
function changeImage(x, image){
    if (x == 1){
        image.src = 'https://otherplanet.photo/wp-content/uploads/2020/04/product-photography-professional-cosmetics-advertising.jpg'
        image.width = "600"
        image.height = "400"
    } else if (x == 2){
        image.src = 'assets/home-cover.jpg'
        image.width = "600"
        image.height = "400"
    }
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

