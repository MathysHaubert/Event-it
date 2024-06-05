document.addEventListener('DOMContentLoaded', function() {
    const faqContainer = document.getElementById('faq-container');

    fetch('fetch_faq.php')
        .then(response => response.json())
        .then(data => {
            data.forEach(faq => {
                const faqItem = document.createElement('div');
                faqItem.classList.add('faq-item');

                const question = document.createElement('div');
                question.classList.add('question');
                question.textContent = faq.question;
                question.addEventListener('click', () => {
                    answer.style.display = answer.style.display === 'none' ? 'block' : 'none';
                });

                const answer = document.createElement('div');
                answer.classList.add('answer');
                answer.textContent = faq.answer;

                faqItem.appendChild(question);
                faqItem.appendChild(answer);
                faqContainer.appendChild(faqItem);
            });
        });
});
