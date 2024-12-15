<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Sampaikan aspirasi dan pengaduan Anda demi pembangunan bersama." />
        <meta name="author" content="Pemerintah Kota Anda" />
        <title>Pengaduan Masyarakat</title>
        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body class="bg-gray-100 text-gray-800">
        <!-- Masthead -->
        <header class="h-screen flex flex-col md:flex-row">
            <!-- Left Section with Gradient Background -->
            <div class="w-full md:w-2/3 bg-gradient-to-r from-blue-900 via-indigo-700 to-purple-700 rounded-br-[50px] flex justify-center items-center p-8">
                <div class="text-center">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight">
                        Pengaduan Masyarakat
                    </h1>
                    <hr class="w-24 h-1 my-4 mx-auto bg-white border-0 rounded" />
                    <p class="text-white text-md md:text-lg lg:text-xl mb-8 max-w-lg mx-auto">
                        Sampaikan aspirasi dan pengaduan Anda demi pembangunan bersama. Mari kita wujudkan masyarakat yang lebih baik!
                    </p>
                    <a href="{{ route('login.auth') }}" 
                       class="bg-white text-blue-500 px-6 py-3 rounded-full text-lg font-semibold shadow-md hover:bg-gray-200 transition duration-300 ease-in-out">
                        Mulai Pengaduan
                    </a>
                </div>
            </div>

            <!-- Right Section with Image as Background -->
            <div class="w-full md:w-1/3 bg-cover bg-center rounded-tl-[50px] md:rounded-bl-none" 
                 style="background-image: url('https://i.pinimg.com/736x/8d/73/7c/8d737c85e37ba1f0d4609fbf4ea865ee.jpg');" 
                 aria-label="Background Image - Pengaduan Masyarakat">
            </div>
        </header>

        <!-- Footer -->
        <footer class="bg-gray-800 py-6">
            <div class="container mx-auto text-center">
                <p class="text-gray-400 text-sm">
                    Copyright &copy; 2023 - Pemerintah Kota Anda. All Rights Reserved.
                </p>
            </div>
        </footer>
    </body>
</html>
