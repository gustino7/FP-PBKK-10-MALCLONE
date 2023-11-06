<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body class="bg-white text-blue-700 flex items-center justify-center h-screen">
    <div class="container mx-auto px-4 py-5">
        <h1 class="text-3xl font-bold text-center">Login to MyAnimeList</h1>
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-1/3 mx-auto">
            <!-- ... -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="Email">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************">
            </div>
            <div class="flex items-center justify-center">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                    Login
                </button>
            </div>
            <div class="flex justify-center mt-2">
                <a href="/register" class="text-blue-700 text-sm">Don't have an account? Register</a>
            </div>
        </form>

    </div>
</body>

</html>