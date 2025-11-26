document.addEventListener("DOMContentLoaded", function () {
    const posts = document.querySelectorAll('.post');
    const blurImages = document.querySelectorAll('.canBlurImage');

    posts.forEach(post => {
        post.addEventListener('mouseenter', () => {
            blurImages.forEach(img => {
                img.classList.add('blurred');
            });
        });

        post.addEventListener('mouseleave', () => {
            blurImages.forEach(img => {
                img.classList.remove('blurred');
            });
        });
    });
});

const overlay = document.querySelector('.blur-overlay');
const posts = document.querySelectorAll('.post');

posts.forEach(post => {
    post.addEventListener('mouseenter', () => {
        overlay.style.opacity = "1";
    });
    post.addEventListener('mouseleave', () => {
        overlay.style.opacity = "0";
    });
});
