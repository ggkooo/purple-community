<?php
require_once __DIR__ . '/partials/html-start.php';
?>
<div class="hero">
    <div class="login-container">
        <form>
            <div class="mb-4">
                <label for="username" class="form-label color-white">User:</label>
                <input type="text" class="form-control bg-color-heavy-gray" id="username">
            </div>
            <div class="mb-5">
                <label for="password" class="form-label color-white">Password:</label>
                <input type="password" class="form-control bg-color-heavy-gray" id="password">
            </div>
            <button type="submit" class="btn btn-purple w-100">Enter</button>
        </form>
    </div>
</div>

<?php
require_once __DIR__ . '/partials/html-end.php';
