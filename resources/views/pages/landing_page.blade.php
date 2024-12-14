<!DOCTYPE html>
<html lang="="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Pengaduan Masyarakat</title>
        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100 text-gray-800">
        <!-- Masthead -->
        <header class="h-screen flex">
            <!-- Left Section with Gradient Background -->
            <div class="w-2/3 bg-gradient-to-r from-blue-900 via-indigo-700 to-purple-700 rounded-br-[50px]">
                <div class="h-full flex flex-col justify-center items-center p-8 text-center">
                    <h1 class="text-5xl md:text-6xl font-bold text-white">Pengaduan Masyarakat</h1>
                    <hr class="w-24 h-1 my-4 bg-white border-0 rounded">
                    <p class="text-white text-lg md:text-xl mb-8">Sampaikan aspirasi dan pengaduan Anda demi pembangunan bersama. Mari kita wujudkan masyarakat yang lebih baik!</p>
                    <a href="{{route('guest.dashboard')}}" class="bg-white text-blue-500 px-6 py-3 rounded-full text-lg font-semibold shadow hover:bg-gray-200">Mulai Pengaduan</a>
                </div>
            </div>

            <!-- Right Section with Image as Background -->
            <div class="w-1/3 bg-cover bg-center bg-no-repeat rounded-tl-[50px]" style="background-image: url('https://i.pinimg.com/736x/8d/73/7c/8d737c85e37ba1f0d4609fbf4ea865ee.jpg')">
            </div>
        </header>

        <!-- Footer -->
        <footer class="bg-gray-800 py-6">
            <div class="container mx-auto text-center">
                <p class="text-gray-400 text-sm">Copyright &copy; 2023 - Pemerintah Kota Anda</p>
            </div>
        </footer>
    </body>
</html>

