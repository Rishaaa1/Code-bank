<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Coming Soon</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .fade-in {
      animation: fadeIn 1s ease-out forwards;
    }
  </style>
</head>
<body class="bg-gradient-to-br from-green-50 via-white to-green-100 min-h-screen flex items-center justify-center px-4">


  <div class="text-center fade-in max-w-xl w-full">


    <h1 class="text-2xl sm:text-4xl font-bold text-green-800 mb-4">Segera Hadir!</h1>
    <p class="text-gray-600 text-base sm:text-lg mb-6 leading-relaxed">
      Beberapa fitur Bank Syariah kami sedang dalam tahap pengembangan.<br>
      Kami akan segera hadir dengan pengalaman yang lebih baik untuk Anda.
    </p>

    <div class="flex flex-col sm:flex-row justify-center gap-4 mb-8">
      <div class="bg-white shadow rounded-lg p-4 w-full sm:w-auto">
        <p class="text-xl sm:text-2xl font-bold text-green-700">belum ada info</p>
        <p class="text-sm text-gray-500">Hari</p>
      </div>
      <div class="bg-white shadow rounded-lg p-4 w-full sm:w-auto">
        <p class="text-xl sm:text-2xl font-bold text-green-700">belum ada info</p>
        <p class="text-sm text-gray-500">Jam</p>
      </div>
      <div class="bg-white shadow rounded-lg p-4 w-full sm:w-auto">
        <p class="text-xl sm:text-2xl font-bold text-green-700">belum ada info</p>
        <p class="text-sm text-gray-500">Menit</p>
      </div>
    </div>

    <p class="mt-10 text-xs text-gray-500">&copy; 2025 Bank Jateng Syariah. Semua hak dilindungi.</p>
  </div>

</body>
</html>
