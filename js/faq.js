document.addEventListener('DOMContentLoaded', function() {
    const questions = document.querySelectorAll('.fa-faq__question');

    // Remove hidden attribute from all answers on load
    document.querySelectorAll('.fa-faq__answer').forEach(function(answer) {
        answer.removeAttribute('hidden');
    });

    questions.forEach(function(question) {
        question.addEventListener('click', function() {
            const answerId = this.getAttribute('aria-controls');
            const answer = document.getElementById(answerId);
            const isExpanded = this.getAttribute('aria-expanded') === 'true';

            // Close all others
            questions.forEach(function(q) {
                const otherId = q.getAttribute('aria-controls');
                const otherAnswer = document.getElementById(otherId);
                q.setAttribute('aria-expanded', 'false');
                otherAnswer.classList.remove('is-open');
            });

            // Toggle current
            if (!isExpanded) {
                this.setAttribute('aria-expanded', 'true');
                answer.classList.add('is-open');
            }
        });
    });
});