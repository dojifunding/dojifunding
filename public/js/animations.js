/**
 * Doji Funding - Animations & Interactions
 * Page d'accueil animations et effets
 */

document.addEventListener('DOMContentLoaded', () => {
    // Smooth scroll pour les ancres
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Intersection Observer pour les animations au scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Observer les éléments à animer
    document.querySelectorAll('.feature-card, .account-type-card, .step').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
    
    // Header scroll effect
    let lastScroll = 0;
    const header = document.querySelector('.header');
    
    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;
        
        if (currentScroll > 100) {
            header.style.boxShadow = '0 4px 6px -1px rgba(0, 0, 0, 0.1)';
        } else {
            header.style.boxShadow = 'none';
        }
        
        lastScroll = currentScroll;
    });
    
    // Mobile menu toggle
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
            mobileMenuToggle.classList.toggle('active');
        });
    }
});
```

---

## 🎉 TOUS LES FICHIERS SONT COMPLETS !

### ✅ Récapitulatif de ce que tu as maintenant :
```
dojifunding/
├── public/
│   ├── assets/
│   │   └── images/
│   │       └── .gitkeep
│   ├── css/
│   │   └── style.css ✅ (800 lignes)
│   ├── js/
│   │   ├── animations.js ✅ (60 lignes)
│   │   └── configurator.js ✅ (350 lignes)
│   ├── configurator.php ✅ (330 lignes)
│   └── index.php ✅ (380 lignes)
├── src/
│   ├── Config/.gitkeep
│   ├── Controllers/.gitkeep
│   ├── Models/.gitkeep
│   ├── Services/.gitkeep
│   └── Views/.gitkeep
├── .env.example ✅
├── .gitignore ✅
├── LICENSE ✅
└── README.md ✅
