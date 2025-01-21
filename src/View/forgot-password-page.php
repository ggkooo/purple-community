<?php
require_once __DIR__ . '/partials/html-start.php';
?>
<div class="hero">
    <div class="login-container">
        <form method="post">
            <div class="mb-4">
                <label for="user_email" class="form-label color-white">Email:</label>
                <input type="text" id="user_email" name="user_email" class="form-control bg-color-heavy-gray">
            </div>
            <button type="submit" class="btn btn-purple w-100">Enter</button>
            <div class="back mt-5"><a class="color-primary" href="/login">← Back</a></div>
        </form>
    </div>
</div>

<?php
require_once __DIR__ . '/partials/html-end.php';
