<div class="relative text-white">
    <button id="account-btn" class="bg-gray-800 text-white p-2 rounded-full">Account</button>
    <!-- <div id="account-menu" class="hidden absolute right-0 w-48 bg-gray-900 border border-gray-400 rounded-lg"> -->
    <div id="account-menu" class="hidden absolute right-0 w-48 border border-gray-400 rounded-lg" style="background-color: #111;">
        <div class="p-2"><?php echo $_SESSION['session_user_name'] ?? 'Guest'; ?></div>
        <a href="../myProfile/index.php" class="block p-2 border-b border-gray-400">My Profile</a>
        <a href="../setting/index.php" class="block p-2 border-b border-gray-400">Settings</a>
        <a href="../user/logout.php" class="block p-2">Logout</a>
    </div>
</div>

<script>
    document.getElementById('account-btn').addEventListener('click', function() {
        var menu = document.getElementById('account-menu');
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    });

    window.addEventListener('click', function(e) {
        if (!document.getElementById('account-btn').contains(e.target)) {
            document.getElementById('account-menu').style.display = 'none';
        }
    });
</script>
