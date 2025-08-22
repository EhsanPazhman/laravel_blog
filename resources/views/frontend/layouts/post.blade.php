<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Post Details</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-900 text-gray-100 font-inter">
    <!-- Navigation -->
    <nav class="bg-gradient-to-r from-blue-700 to-purple-600 text-white p-6 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-bold tracking-tight">My Blog</h1>
            <div class="space-x-6">
                <a href="index.html" class="hover:text-blue-300 transition-colors duration-200">Home</a>
                <a href="login.html" class="hover:text-blue-300 transition-colors duration-200">Login</a>
                <a href="register.html" class="hover:text-blue-300 transition-colors duration-200">Register</a>
                <a href="admin.html" class="hover:text-blue-300 transition-colors duration-200">Admin Panel</a>
            </div>
        </div>
    </nav>

    <!-- Post Details -->
    <div class="container mx-auto my-8 px-4">
        <div class="bg-gray-800 p-8 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold text-blue-300 mb-4">Sample Post Title</h1>
            <p class="text-gray-400 text-sm mb-4">Category: Technology | Published: 2025-08-17</p>
            <img src="https://via.placeholder.com/600x400" alt="Post Image" class="w-full h-64 object-cover rounded-lg mb-6">
            <p class="text-gray-200 leading-relaxed">This is the full content of the blog post. Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
        </div>
    </div>

    <!-- Comments -->
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-semibold text-blue-300 mb-4">Comments</h2>
        <div class="bg-gray-800 p-6 rounded-lg shadow-md mb-6">
            <p class="text-gray-200">Great post!</p>
            <p class="text-gray-400 text-sm">By User123 | 2025-08-17</p>
        </div>
        <!-- Comment Form -->
        <form action="post.html" method="POST" class="bg-gray-800 p-6 rounded-lg shadow-md">
            <textarea name="comment" placeholder="Add your comment..." class="w-full p-3 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition" required></textarea>
            <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white p-3 rounded-lg mt-4 transition-colors duration-200">Submit Comment</button>
        </form>
    </div>
</body>
</html>