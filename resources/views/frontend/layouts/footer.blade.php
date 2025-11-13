    <footer class="bg-gradient-to-r from-blue-700 to-purple-600 text-white p-6 mt-8 rounded-t-md">
        <div class="container mx-auto text-center">
            <p class="text-sm">&copy; 2025 Ehsan Pazhman. All rights reserved.</p>
        </div>
    </footer>
        <!-- Like AJAX Script -->
    <script>
        document.querySelectorAll('.like-btn').forEach(btn => {
            btn.addEventListener('click', async () => {

                if (btn.dataset.auth === '0') {
                    window.location.href = '{{ route('login.form') }}';
                    return;
                }

                const postId = btn.dataset.postId;
                const res = await fetch(`/post/${postId}/like`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                });

                if (!res.ok) return;

                const data = await res.json();

                btn.querySelector('.like-count').textContent = data.likes_count;
                if (data.liked) {
                    btn.classList.add('text-pink-500');
                } else {
                    btn.classList.remove('text-pink-500');
                }
            });
        });
    </script>
</body>
</html>