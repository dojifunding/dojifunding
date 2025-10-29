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
