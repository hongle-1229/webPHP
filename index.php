<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Trang Chủ - Website Sản Phẩm</title>
  <!-- Link Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <link rel="stylesheet" href="assets/css/index.css">

  <style>
    /* Hiệu ứng fade */
    .fade-in {
      animation: fadeIn 2s forwards;
    }

    .fade-out {
      animation: fadeOut 2s forwards;
    }

    @keyframes fadeIn {
      0% {
        opacity: 0;
      }
      100% {
        opacity: 1;
      }
    }

    @keyframes fadeOut {
      0% {
        opacity: 1;
      }
      100% {
        opacity: 0;
      }
    }

    /* Đảm bảo slider ảnh chiếm màn hình */
    .slider img {
      width: 100%;
      height: 100vh;
      object-fit: cover;
    }
  </style>
</head>

<body class="bg-gray-100 text-gray-800">

<header class="bg-white shadow-md">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <h1 class="text-2xl font-bold text-indigo-600">Ankyo</h1>
            <nav>
                <ul class="flex space-x-4">
                    <li><a href="index.php" class="hover:text-indigo-600">Trang Chủ</a></li>
                    <li><a href="includes/product.php" class="hover:text-indigo-600">Sản Phẩm</a></li>
                    <li><a href="#" class="hover:text-indigo-600">Bài viết</a></li>
                    <li><a href="#" class="hover:text-indigo-600">Liên Hệ</a></li>
                </ul>
            </nav>
        </div>
    </header>

  <!-- Slider Fullscreen -->
  <div class="relative w-full h-screen overflow-hidden slider">
    <img src="https://marketingbox.vn/wp-content/uploads/2024/08/Tam-quan-trong-cua-chup-anh-thoi-trang.jpg" alt="Slide 1"
      class="absolute inset-0 w-full h-screen object-cover opacity-0">
    <img src="https://blog.flipbuilder.com/wp-content/uploads/2023/09/Pretty-Lookbook-Magazine-Template.png" alt="Slide 2"
      class="absolute inset-0 w-full h-screen object-cover opacity-0">
    <img src="https://as2.ftcdn.net/v2/jpg/04/84/73/59/1000_F_484735903_aO83DUGan3oEWGe05FNi6T9dsTqXKQXR.jpg" alt="Slide 3"
      class="absolute inset-0 w-full h-screen object-cover opacity-0">
  </div>


  <section class="bg-indigo-600 text-white py-20">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl font-bold mb-4">Chào Mừng Đến Với Ankyo</h2>
            <p class="text-lg mb-6">Khám phá các sản phẩm chất lượng và ưu đãi hấp dẫn ngay hôm nay!</p>
            <a href="includes/product.php" class="bg-white text-indigo-600 py-2 px-4 rounded-lg font-semibold shadow-md hover:bg-gray-100">Xem Sản Phẩm</a>
        </div>
    </section>

    <section class="py-12 bg-white">
  <div class="container mx-auto flex flex-col lg:flex-row items-center lg:space-x-8 px-6">
    <!-- Ảnh giới thiệu -->
    <div class="lg:w-1/2 mb-6 lg:mb-0">
      <img src="https://cafefcdn.com/thumb_w/640/203337114487263232/2022/3/19/photo1647663335803-16476633358961036942046.png" alt="Giới thiệu cửa hàng"
        class="rounded-lg shadow-lg w-full h-auto object-cover">
    </div>

    <!-- Văn bản giới thiệu -->
    <div class="lg:w-1/2">
      <h2 class="text-4xl font-bold text-indigo-600 mb-4">Chào mừng bạn đến với Ankyo</h2>
      <p class="text-gray-700 text-lg mb-6">
        
Ankyo – điểm đến dành cho quý ông yêu thích phong cách và đẳng cấp. Chuyên cung cấp các sản phẩm thời trang hàng hiệu dành riêng cho nam giới, Ankyo mang đến sự tinh tế và sang trọng trong từng chi tiết. Từ trang phục, phụ kiện đến giày dép, mỗi sản phẩm tại Ankyo đều được tuyển chọn kỹ lưỡng, khẳng định gu thẩm mỹ đỉnh cao và chất lượng vượt trội.
      </p>
      <p class="text-gray-700 text-lg mb-6">
        Hãy khám phá ngay để tận hưởng ưu đãi hấp dẫn và trải nghiệm mua sắm tuyệt vời cùng chúng tôi!
      </p>
      <a href="#"
        class="bg-indigo-600 text-white py-3 px-6 rounded-lg shadow-lg hover:bg-indigo-700 transition duration-300">
        Khám Phá Ngay
      </a>
    </div>
  </div>
</section>


  <!-- Footer -->
  <footer class="bg-gray-800 text-gray-300 py-6">
    <div >

    </div>
    <div class="container mx-auto text-center">
      <p>© 2024 Ankyo. All rights reserved.</p>
    </div>
  </footer>

  <!-- JavaScript -->
  <script>
    const slides = document.querySelectorAll('.slider img');
    let currentIndex = 0;

    function showNextSlide() {
      // Ẩn tất cả ảnh
      slides.forEach(slide => {
        slide.classList.remove('fade-in');
        slide.classList.remove('fade-out');
      });

      // Hiện ảnh hiện tại
      const currentSlide = slides[currentIndex];
      currentSlide.classList.add('fade-in');

      // Thêm hiệu ứng fade-out sau 4 giây
      setTimeout(() => {
        currentSlide.classList.remove('fade-in');
        currentSlide.classList.add('fade-out');
      }, 2000);

      // Chọn slide tiếp theo sau khoảng 4 giây
      setTimeout(() => {
        currentSlide.classList.remove('fade-out');
        currentIndex = (currentIndex + 1) % slides.length;
        showNextSlide();
      }, 4000);
    }

    // Bắt đầu slider
    showNextSlide();
  </script>
</body>

</html>
