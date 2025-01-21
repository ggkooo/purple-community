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
            <div class="mb-4">
                <label for="user_email" class="form-label color-white">Email:</label>
                <input type="email" id="user_email" name="user_email" class="form-control bg-color-heavy-gray">
            </div>
            <div class="mb-4">
                <label for="user_password" class="form-label color-white">Password:</label>
                <input type="password" id="user_password" name="user_password" class="form-control bg-color-heavy-gray">
            </div>
            <div class="mb-4">
                <label for="user_confirm_password" class="form-label color-white">Confirm password:</label>
                <input type="password" id="user_confirm_password" name="user_confirm_password" class="form-control bg-color-heavy-gray">
            </div>
            <button type="submit" class="btn btn-purple w-100">Enter</button>
            <p class="color-white mt-5 mb-0">If you have an account, click <a class="color-primary" href="/login">here</a>.</p>
        </form>
    </div>
</div>

<?php
require_once __DIR__ . '/partials/html-end.php';
