<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - Sistem Puskesmas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md">
            <!-- Success Card -->
            <div class="rounded-lg border border-gray-200 bg-white p-8 shadow-sm">
                <!-- Success Icon -->
                <div class="flex justify-center mb-6">
                    <div class="inline-flex items-center justify-center rounded-full bg-green-100 p-6">
                        <svg class="h-12 w-12 text-green-600 animate-pulse" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Main Message -->
                <div class="text-center space-y-2 mb-8">
                    <h2 class="text-3xl font-bold text-gray-900">Logout Berhasil</h2>
                    <p class="text-gray-600 text-lg">Anda telah berhasil keluar dari sistem Puskesmas.</p>
                </div>

                <!-- Info Box -->
                <div class="rounded-lg bg-blue-50 border border-blue-200 p-4 mb-8">
                    <div class="flex items-start gap-3">
                        <svg class="h-5 w-5 text-blue-600 mt-0.5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        <p class="text-sm text-blue-800">Anda akan diarahkan ke halaman login dalam <span class="font-semibold countdown">3</span> detik...</p>
                    </div>
                </div>

                <!-- Button Group -->
                <div class="flex gap-3 flex-col sm:flex-row justify-center">
                    <a href="/login" class="inline-flex items-center justify-center px-6 py-2.5 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 transition-colors">
                        <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6.75L12 3.25m0 0L8.25 6.75M12 3.25v18.5" />
                        </svg>
                        Login Kembali
                    </a>
                    <a href="/" class="inline-flex items-center justify-center px-6 py-2.5 rounded-lg bg-gray-200 text-gray-900 font-semibold hover:bg-gray-300 transition-colors">
                        <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M20.25 7.5H3.75" />
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        let countdown = 3;
        const countdownElement = document.querySelector('.countdown');
        
        const interval = setInterval(function() {
            countdown--;
            if (countdownElement) {
                countdownElement.textContent = countdown;
            }
            
            if (countdown <= 0) {
                clearInterval(interval);
                window.location.href = '/login';
            }
        }, 1000);
    </script>
</body>
</html>
