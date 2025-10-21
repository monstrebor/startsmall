document.addEventListener('DOMContentLoaded', () => {
    const quoteContainer = document.getElementById('quoteContainer');
    if (!quoteContainer) return;

    fetch('/json/quotes.json')
        .then(res => res.json())
        .then(data => {
            const randomQuote = data[Math.floor(Math.random() * data.length)];

            const quoteCard = document.createElement('div');
            quoteCard.className = `
                w-full 
                max-w-screen-xl 
                py-6 
                px-8 
                bg-white 
                border-t-4 border-b-4 border-gray-900 
                rounded-none 
                shadow-md 
                text-center 
                flex flex-col justify-center items-center
                animate-fade-in
            `;

            quoteCard.innerHTML = `
                <p class="text-gray-900 text-3xl md:text-4xl lg:text-5xl font-serif font-bold mb-4 leading-tight">
                    "${randomQuote.text}"
                </p>
                <p class="text-gray-700 text-xl md:text-2xl font-semibold">— ${randomQuote.author}</p>
            `;

            quoteContainer.appendChild(quoteCard);
        })
        .catch(err => {
            console.error('Failed to load quote:', err);
            quoteContainer.innerHTML = `<p class="text-red-500 text-lg">Failed to load quote.</p>`;
        });
});