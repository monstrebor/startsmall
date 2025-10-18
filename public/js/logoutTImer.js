(function () {
    let logoutTimer;

    function autoLogout() {
        fetch('/logout', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        }).then(() => {
            window.location.href = "/";
        }).catch((err) => {
            console.error("Logout failed:", err);
        });
    }

    function resetTimer() {
        clearTimeout(logoutTimer);
        logoutTimer = setTimeout(autoLogout, 10 * 60 * 1000); // 10 minutes
    }

    ['click', 'mousemove', 'keydown', 'scroll', 'touchstart'].forEach(event => {
        window.addEventListener(event, resetTimer);
    });

    resetTimer();
})();