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
```

**🚨 STOP** : Le fichier `index.php` est TRÈS LONG (plus de 500 lignes).

### 💡 Solution Recommandée

Je vais te donner **2 options** :

---

## 🎯 Option A : Créer en Plusieurs Parties (Recommandé)

Je découpe `index.php` en **sections** que tu copieras une par une.

### ✅ Avantages :
- Pas d'erreur de copier-coller
- Tu comprends chaque section
- Facile à vérifier

### ❌ Inconvénient :
- Plusieurs étapes

---

## 🎯 Option B : Upload Direct (Plus Rapide)

Si tu as les fichiers sur ton PC :

1. **Add file** → **Upload files**
2. **Glisser-déposer tous les fichiers** d'un coup
3. **Commit** : `🚀 Initial upload - Complete project`

### ✅ Avantages :
- Ultra rapide
- Un seul commit

### ❌ Inconvénient :
- Tu dois avoir les fichiers déjà créés sur ton PC

---

## 🤔 Quelle Option Préfères-tu ?

**Dis-moi ce que tu veux faire** :

### Option 1️⃣ : "Créer fichier par fichier sur GitHub"
→ Je te guide pour créer chaque fichier avec le contenu complet

### Option 2️⃣ : "J'ai les fichiers sur mon PC, je veux les uploader"
→ Je t'explique comment faire l'upload en masse

### Option 3️⃣ : "Je veux utiliser GitHub Desktop"
→ Je t'explique comment installer et utiliser GitHub Desktop (le plus simple)

---

## 🎨 Pendant que tu choisis, voici un Aperçu

Voici les fichiers qu'on doit créer :
```
doji-funding/
├── public/
│   ├── assets/
│   │   └── images/
│   │       └── .gitkeep ✅ (déjà fait si tu as suivi)
│   ├── css/
│   │   └── style.css 📝 (à créer - 800 lignes)
│   ├── js/
│   │   ├── animations.js 📝 (à créer - 60 lignes)
│   │   └── configurator.js 📝 (à créer - 350 lignes)
│   ├── configurator.php 📝 (à créer - 400 lignes)
│   └── index.php 📝 (à créer - 500 lignes)
├── src/
│   ├── Config/
│   │   └── .gitkeep ✅
│   ├── Controllers/
│   │   └── .gitkeep ✅
│   ├── Models/
│   │   └── .gitkeep ✅
│   ├── Services/
│   │   └── .gitkeep ✅
│   └── Views/
│       └── .gitkeep ✅
├── .env.example ✅ (déjà fait)
├── .gitignore ✅ (déjà fait)
├── LICENSE ✅ (créé automatiquement)
└── README.md 📝 (à modifier)
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
