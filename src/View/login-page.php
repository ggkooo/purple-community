<?php
require_once __DIR__ . '/partials/html-start.php';
?>
<div class="hero">
    <div class="login-container">
        <form method="post">
            <div class="mb-4">
                <label for="user" class="form-label color-white">User:</label>
                <input type="text" id="user" name="user" class="form-control bg-color-heavy-gray">
            </div>
            <div class="mb-5">
                <label for="user_password" class="form-label color-white">Password:</label>
                <input type="password" id="user_password" name="user_password" class="form-control bg-color-heavy-gray">
            </div>
            <button type="submit" class="btn btn-purple w-100">Enter</button>
            <div class="forgot-password mt-3"><a class="color-primary" href="/forgot-password">Forgot password?</a></div>
            <p class="color-white mt-3   mb-0">If you don't have an account, click <a class="color-primary" href="/register">here</a>.</p>
        </form>
    </div>
</div>

<?php
require_once __DIR__ . '/partials/html-end.php';
