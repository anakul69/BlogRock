document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('subscription-form');
    const message = document.getElementById('form-message');

    if (!form || !message) return;

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        const email = form.email.value.trim();

        if (!email || !email.includes('@')) {
            message.textContent = 'Enter a correct email';
            message.className = 'mt-4 text-red-500 font-semibold';
            return;
        }

        try {
            const response = await fetch(window.blogrock.ajax_url, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({
                    action: 'subscription_form',
                    email: email,
                }),
            });

            const result = await response.json();

            if (result.success) {
                message.textContent = 'Your request has been sent!';
                message.className = 'mt-4 text-green-400 font-semibold';
                form.reset();
            } else {
                message.textContent = 'Sending error. Try again later.';
                message.className = 'mt-4 text-red-500 font-semibold';
            }
        } catch (error) {
            console.error('AJAX Error:', error);
            message.textContent = 'The server is unavailable. Try again later.';
            message.className = 'mt-4 text-red-500 font-semibold';
        }
    });
});
