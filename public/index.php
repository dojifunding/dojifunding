<?php
/**
 * Doji Funding - Page d'accueil
 * Plateforme PropFirm avec configurateur personnalisé
 */

session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doji Funding - PropFirm Trading Personnalisée</title>
    <meta name="description" content="Créez votre évaluation de trading sur mesure avec Doji Funding. Configuration 100% personnalisable.">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header / Navigation -->
    <header class="header">
        <nav class="nav-container">
            <div class="logo">
                <h1>DOJI <span class="logo-accent">FUNDING</span></h1>
            </div>
            <ul class="nav-menu">
                <li><a href="#home" class="nav-link active">Accueil</a></li>
                <li><a href="#features" class="nav-link">Avantages</a></li>
                <li><a href="#configurator" class="nav-link">Configurateur</a></li>
                <li><a href="#contact" class="nav-link">Contact</a></li>
            </ul>
            <a href="configurator.php" class="btn-primary">Commencer</a>
            <button class="mobile-menu-toggle" aria-label="Menu mobile">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </nav>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-background">
            <div class="gradient-orb orb-1"></div>
            <div class="gradient-orb orb-2"></div>
        </div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <span class="hero-badge">🚀 La PropFirm Personnalisable</span>
                    <h2 class="hero-title">
                        Créez Votre Évaluation<br>
                        <span class="gradient-text">100% Sur Mesure</span>
                    </h2>
                    <p class="hero-description">
                        Doji Funding révolutionne le trading propriétaire. Configurez chaque aspect 
                        de votre évaluation : montant, risque, targets, leverage... Vous décidez, 
                        nous finançons.
                    </p>
                    <div class="hero-cta">
                        <a href="configurator.php" class="btn-primary btn-large">
                            <span>Configurer Mon Compte</span>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M7.5 15L12.5 10L7.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </a>
                        <a href="#features" class="btn-secondary btn-large">En Savoir Plus</a>
                    </div>
                    <div class="hero-stats">
                        <div class="stat">
                            <span class="stat-number">10M+</span>
                            <span class="stat-label">Configurations</span>
                        </div>
                        <div class="stat">
                            <span class="stat-number">100%</span>
                            <span class="stat-label">Personnalisable</span>
                        </div>
                        <div class="stat">
                            <span class="stat-number">24/7</span>
                            <span class="stat-label">Support</span>
                        </div>
                    </div>
                </div>
                <div class="hero-image">
                    <div class="floating-card card-1">
                        <div class="card-icon">📊</div>
                        <div class="card-content">
                            <div class="card-title">Account Size</div>
                            <div class="card-value">$100,000</div>
                        </div>
                    </div>
                    <div class="floating-card card-2">
                        <div class="card-icon">🎯</div>
                        <div class="card-content">
                            <div class="card-title">Profit Target</div>
                            <div class="card-value">10%</div>
                        </div>
                    </div>
                    <div class="floating-card card-3">
                        <div class="card-icon">⚡</div>
                        <div class="card-content">
                            <div class="card-title">Max Drawdown</div>
                            <div class="card-value">5%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Pourquoi Choisir <span class="gradient-text">Doji Funding</span> ?</h2>
                <p class="section-description">
                    Une flexibilité inégalée pour les traders de tous niveaux
                </p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🎨</div>
                    <h3 class="feature-title">Configuration Illimitée</h3>
                    <p class="feature-description">
                        Ajustez chaque paramètre : taille du compte, drawdown, targets, 
                        leverage, consistency rules et bien plus.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">💰</div>
                    <h3 class="feature-title">Prix Dynamique</h3>
                    <p class="feature-description">
                        Payez uniquement pour ce dont vous avez besoin. Plus vous êtes 
                        conservateur, moins vous payez.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">⚡</div>
                    <h3 class="feature-title">Instant Funding</h3>
                    <p class="feature-description">
                        Option de financement instantané disponible. Tradez immédiatement 
                        avec un compte réel.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🛡️</div>
                    <h3 class="feature-title">Risque Personnalisé</h3>
                    <p class="feature-description">
                        Choisissez entre Static, Trailing ou EOD Drawdown. Adaptez la 
                        gestion du risque à votre style.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📈</div>
                    <h3 class="feature-title">Profit Split Flexible</h3>
                    <p class="feature-description">
                        De 50% à 100% de profit share. Vous décidez de votre rémunération 
                        en fonction de vos performances.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🎯</div>
                    <h3 class="feature-title">Targets Adaptables</h3>
                    <p class="feature-description">
                        Définissez vos objectifs de profit de 2% à 25%. Plus l'objectif 
                        est ambitieux, plus le prix est avantageux.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Account Types Section -->
    <section class="account-types">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Choisissez Votre <span class="gradient-text">Programme</span></h2>
                <p class="section-description">Trois modèles d'évaluation pour tous les profils</p>
            </div>
            <div class="account-types-grid">
                <div class="account-type-card">
                    <div class="account-badge">Populaire</div>
                    <div class="account-icon">🥇</div>
                    <h3 class="account-name">2 Steps</h3>
                    <p class="account-description">
                        Deux phases d'évaluation pour prouver votre consistance. 
                        Le meilleur rapport qualité/prix.
                    </p>
                    <ul class="account-features">
                        <li>✓ Phase 1 : Target principal</li>
                        <li>✓ Phase 2 : Confirmation</li>
                        <li>✓ Compte financé après succès</li>
                        <li>✓ Configuration 100% libre</li>
                    </ul>
                    <a href="configurator.php?type=2steps" class="btn-primary btn-full">Configurer</a>
                </div>
                <div class="account-type-card">
                    <div class="account-icon">🥈</div>
                    <h3 class="account-name">3 Steps</h3>
                    <p class="account-description">
                        Trois étapes progressives pour maximiser vos chances. 
                        Idéal pour les débutants.
                    </p>
                    <ul class="account-features">
                        <li>✓ Phase 1, 2 & 3 : Progression</li>
                        <li>✓ Objectifs échelonnés</li>
                        <li>✓ Plus de marge d'apprentissage</li>
                        <li>✓ Tarifs optimisés</li>
                    </ul>
                    <a href="configurator.php?type=3steps" class="btn-secondary btn-full">Configurer</a>
                </div>
                <div class="account-type-card">
                    <div class="account-badge">Premium</div>
                    <div class="account-icon">⚡</div>
                    <h3 class="account-name">Instant Funding</h3>
                    <p class="account-description">
                        Accès immédiat à un compte financé. Pour les traders 
                        expérimentés qui veulent agir vite.
                    </p>
                    <ul class="account-features">
                        <li>✓ Aucune évaluation</li>
                        <li>✓ Trading immédiat</li>
                        <li>✓ Compte réel dès le jour 1</li>
                        <li>✓ Configuration premium</li>
                    </ul>
                    <a href="configurator.php?type=instant" class="btn-primary btn-full">Configurer</a>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="how-it-works">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Comment Ça <span class="gradient-text">Fonctionne</span> ?</h2>
                <p class="section-description">4 étapes simples pour obtenir votre compte financé</p>
            </div>
            <div class="steps-container">
                <div class="step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h3 class="step-title">Configurez</h3>
                        <p class="step-description">
                            Utilisez notre configurateur pour créer l'évaluation parfaite 
                            selon vos critères et votre budget.
                        </p>
                    </div>
                </div>
                <div class="step-arrow">→</div>
                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h3 class="step-title">Payez</h3>
                        <p class="step-description">
                            Achetez votre évaluation personnalisée au prix calculé 
                            automatiquement par notre algorithme.
                        </p>
                    </div>
                </div>
                <div class="step-arrow">→</div>
                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h3 class="step-title">Tradez</h3>
                        <p class="step-description">
                            Recevez vos identifiants et commencez votre évaluation 
                            avec les règles que vous avez choisies.
                        </p>
                    </div>
                </div>
                <div class="step-arrow">→</div>
                <div class="step">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h3 class="step-title">Gagnez</h3>
                        <p class="step-description">
                            Validez votre évaluation et recevez votre compte financé. 
                            Gardez jusqu'à 100% de vos profits !
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title">Prêt à Créer Votre Compte Personnalisé ?</h2>
                <p class="cta-description">
                    Rejoignez des milliers de traders qui ont choisi la flexibilité de Doji Funding
                </p>
                <a href="configurator.php" class="btn-primary btn-large">
                    <span>Lancer le Configurateur</span>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M7.5 15L12.5 10L7.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3 class="footer-title">DOJI <span class="logo-accent">FUNDING</span></h3>
                    <p class="footer-description">
                        La première PropFirm 100% personnalisable. Créez l'évaluation 
                        qui correspond parfaitement à votre style de trading.
                    </p>
                </div>
                <div class="footer-section">
                    <h4 class="footer-heading">Navigation</h4>
                    <ul class="footer-links">
                        <li><a href="#home">Accueil</a></li>
                        <li><a href="#features">Avantages</a></li>
                        <li><a href="configurator.php">Configurateur</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4 class="footer-heading">Programmes</h4>
                    <ul class="footer-links">
                        <li><a href="configurator.php?type=2steps">2 Steps</a></li>
                        <li><a href="configurator.php?type=3steps">3 Steps</a></li>
                        <li><a href="configurator.php?type=instant">Instant Funding</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4 class="footer-heading">Contact</h4>
                    <ul class="footer-links">
                        <li>📧 support@dojifunding.com</li>
                        <li>💬 Chat en direct 24/7</li>
                        <li>📱 Discord Community</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 Doji Funding. Tous droits réservés.</p>
                <div class="footer-legal">
                    <a href="#">Conditions d'utilisation</a>
                    <a href="#">Politique de confidentialité</a>
                    <a href="#">Mentions légales</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/animations.js"></script>
</body>
</html>
