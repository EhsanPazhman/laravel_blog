<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Edit Category</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-900 text-gray-100 font-inter">
    <!-- Navigation -->
    <nav class="bg-gradient-to-r from-blue-700 to-purple-600 text-white p-6 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-bold tracking-tight">My Blog - Admin</h1>
            <div class="space-x-6">
                <a href="index.html" class="hover:text-blue-300 transition-colors duration-200">Home</a>
                <a href="admin.html" class="hover:text-blue-300 transition-colors duration-200">Admin Panel</a>
                <a href="login.html" class="hover:text-blue-300 transition-colors duration-200">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Edit Category Form -->
    <div class="container mx-auto my-8 px-4">
        <div class="bg-gray-800 p-8 rounded-lg shadow-md max-w-md mx-auto">
            <h2 class="text-2xl font-semibold text-blue-300 mb-6">Edit Category</h2>
            <form action="edit-category.html" method="POST">
                <div class="mb-6">
                    <label for="name" class="block text-gray-300">Category Name</label>
                    <input type="text" name="name" id="name" value="Technology" class="w-full p-3 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition" required>
                </div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white p-3 rounded-lg transition-colors duration-200">Update Category</button>
            </form>
        </div>
    </div>
</body>
</html>