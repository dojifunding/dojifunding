<?php
/**
 * Doji Funding - Configurateur Personnalisé
 * Interface de configuration d'évaluation en temps réel
 */

session_start();

// Récupérer le type de compte depuis l'URL
$accountType = $_GET['type'] ?? '2steps';
$validTypes = ['2steps', '3steps', 'instant'];
if (!in_array($accountType, $validTypes)) {
    $accountType = '2steps';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurateur - Doji Funding</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="configurator-page">
    <!-- Header -->
    <header class="header header-compact">
        <nav class="nav-container">
            <div class="logo">
                <a href="index.php">
                    <h1>DOJI <span class="logo-accent">FUNDING</span></h1>
                </a>
            </div>
            <div class="nav-actions">
                <a href="index.php" class="btn-secondary btn-small">← Retour</a>
            </div>
        </nav>
    </header>

    <!-- Configurator Main -->
    <main class="configurator-main">
        <div class="container-wide">
            <div class="configurator-layout">
                <!-- Left Panel - Configuration -->
                <div class="config-panel">
                    <div class="panel-header">
                        <h2 class="panel-title">Configurez Votre Évaluation</h2>
                        <p class="panel-subtitle">Personnalisez chaque paramètre selon vos besoins</p>
                    </div>

                    <!-- Account Type Selection -->
                    <div class="config-section">
                        <label class="config-label">
                            <span class="label-text">Type de Compte</span>
                            <span class="label-info">Choisissez votre programme</span>
                        </label>
                        <div class="type-selector">
                            <button class="type-btn <?= $accountType === '2steps' ? 'active' : '' ?>" data-type="2steps">
                                <span class="type-icon">🥇</span>
                                <span class="type-name">2 Steps</span>
                            </button>
                            <button class="type-btn <?= $accountType === '3steps' ? 'active' : '' ?>" data-type="3steps">
                                <span class="type-icon">🥈</span>
                                <span class="type-name">3 Steps</span>
                            </button>
                            <button class="type-btn <?= $accountType === 'instant' ? 'active' : '' ?>" data-type="instant">
                                <span class="type-icon">⚡</span>
                                <span class="type-name">Instant</span>
                            </button>
                        </div>
                    </div>

                    <!-- Account Size -->
                    <div class="config-section">
                        <label class="config-label">
                            <span class="label-text">Montant du Compte</span>
                            <span class="label-value" id="accountSizeValue">$10,000</span>
                        </label>
                        <input type="range" class="config-slider" id="accountSize" 
                               min="2000" max="100000" step="2000" value="10000">
                        <div class="slider-labels">
                            <span>$2K</span>
                            <span>$100K</span>
                        </div>
                    </div>

                    <!-- Risk System -->
                    <div class="config-section">
                        <label class="config-label">
                            <span class="label-text">Système de Risque</span>
                            <span class="label-info">Impact sur le prix</span>
                        </label>
                        <div class="radio-group">
                            <label class="radio-card">
                                <input type="radio" name="riskSystem" value="trailing" checked>
                                <div class="radio-content">
                                    <div class="radio-header">
                                        <span class="radio-title">Trailing Drawdown</span>
                                        <span class="price-badge price-low">Le moins cher</span>
                                    </div>
                                    <p class="radio-description">Le drawdown suit votre courbe de profit</p>
                                </div>
                            </label>
                            <label class="radio-card">
                                <input type="radio" name="riskSystem" value="eod">
                                <div class="radio-content">
                                    <div class="radio-header">
                                        <span class="radio-title">EOD Drawdown</span>
                                        <span class="price-badge price-mid">Prix moyen</span>
                                    </div>
                                    <p class="radio-description">Calculé en fin de journée</p>
                                </div>
                            </label>
                            <label class="radio-card">
                                <input type="radio" name="riskSystem" value="static">
                                <div class="radio-content">
                                    <div class="radio-header">
                                        <span class="radio-title">Static Drawdown</span>
                                        <span class="price-badge price-high">Plus cher</span>
                                    </div>
                                    <p class="radio-description">Fixe depuis le solde initial</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Profit Target -->
                    <div class="config-section">
                        <label class="config-label">
                            <span class="label-text">Target de Profit</span>
                            <span class="label-value" id="targetValue">10%</span>
                        </label>
                        <input type="range" class="config-slider" id="profitTarget" 
                               min="2" max="25" step="1" value="10">
                        <div class="slider-labels">
                            <span>2%</span>
                            <span>25%</span>
                        </div>
                        <div class="info-box">
                            <span class="info-icon">ℹ️</span>
                            <span>Plus la target est élevée, moins c'est cher</span>
                        </div>
                    </div>

                    <!-- Max Drawdown -->
                    <div class="config-section">
                        <label class="config-label">
                            <span class="label-text">Perte Maximum Autorisée</span>
                            <span class="label-value" id="drawdownValue">5%</span>
                        </label>
                        <input type="range" class="config-slider" id="maxDrawdown" 
                               min="2" max="25" step="1" value="5">
                        <div class="slider-labels">
                            <span>2%</span>
                            <span>25%</span>
                        </div>
                        <div class="info-box">
                            <span class="info-icon">ℹ️</span>
                            <span>Plus le drawdown est élevé, plus c'est cher</span>
                        </div>
                    </div>

                    <!-- Consistency Rule -->
                    <div class="config-section">
                        <label class="config-label">
                            <span class="label-text">Règle de Consistency</span>
                            <span class="label-info">Limitation du meilleur jour</span>
                        </label>
                        <select class="config-select" id="consistency">
                            <option value="none">Pas de consistency</option>
                            <option value="50">50% maximum</option>
                            <option value="40">40% maximum</option>
                            <option value="30">30% maximum</option>
                            <option value="20">20% maximum</option>
                            <option value="10">10% maximum</option>
                        </select>
                        <div class="info-box">
                            <span class="info-icon">ℹ️</span>
                            <span>Moins de consistency = moins cher</span>
                        </div>
                    </div>

                    <!-- Profit Split -->
                    <div class="config-section">
                        <label class="config-label">
                            <span class="label-text">Split de Profit</span>
                            <span class="label-value" id="splitValue">80%</span>
                        </label>
                        <input type="range" class="config-slider" id="profitSplit" 
                               min="50" max="100" step="10" value="80">
                        <div class="slider-labels">
                            <span>50%</span>
                            <span>100%</span>
                        </div>
                        <div class="info-box">
                            <span class="info-icon">ℹ️</span>
                            <span>Plus le split est élevé, plus c'est cher</span>
                        </div>
                    </div>

                    <!-- Trading Days Evaluation -->
                    <div class="config-section">
                        <label class="config-label">
                            <span class="label-text">Jours de Trading (Évaluation)</span>
                            <span class="label-value" id="evalDaysValue">5 jours minimum</span>
                        </label>
                        <input type="range" class="config-slider" id="evalDays" 
                               min="0" max="20" step="1" value="5">
                        <div class="slider-labels">
                            <span>Aucun</span>
                            <span>20 jours</span>
                        </div>
                        <div class="info-box">
                            <span class="info-icon">ℹ️</span>
                            <span>Plus de jours requis = moins cher</span>
                        </div>
                    </div>

                    <!-- Trading Days Funded -->
                    <div class="config-section">
                        <label class="config-label">
                            <span class="label-text">Jours de Trading (Compte Financé)</span>
                            <span class="label-value" id="fundedDaysValue">3 jours minimum</span>
                        </label>
                        <input type="range" class="config-slider" id="fundedDays" 
                               min="0" max="20" step="1" value="3">
                        <div class="slider-labels">
                            <span>Aucun</span>
                            <span>20 jours</span>
                        </div>
                    </div>

                    <!-- Leverage -->
                    <div class="config-section">
                        <label class="config-label">
                            <span class="label-text">Effet de Levier</span>
                            <span class="label-value" id="leverageValue">1:100</span>
                        </label>
                        <select class="config-select" id="leverage">
                            <option value="1">1:1</option>
                            <option value="10">1:10</option>
                            <option value="20">1:20</option>
                            <option value="30">1:30</option>
                            <option value="50">1:50</option>
                            <option value="100" selected>1:100</option>
                            <option value="200">1:200</option>
                            <option value="300">1:300</option>
                            <option value="400">1:400</option>
                        </select>
                        <div class="info-box">
                            <span class="info-icon">ℹ️</span>
                            <span>Plus le levier est élevé, moins c'est cher</span>
                        </div>
                    </div>

                    <!-- Max Lot Size -->
                    <div class="config-section">
                        <label class="config-label">
                            <span class="label-text">Taille de Lot Maximum</span>
                            <span class="label-value" id="lotSizeValue">5 lots</span>
                        </label>
                        <input type="range" class="config-slider" id="maxLotSize" 
                               min="1" max="10" step="1" value="5">
                        <div class="slider-labels">
                            <span>1 lot</span>
                            <span>10 lots</span>
                        </div>
                        <div class="info-box">
                            <span class="info-icon">ℹ️</span>
                            <span>Plus de lots autorisés = plus cher</span>
                        </div>
                    </div>
                </div>

                <!-- Right Panel - Summary & Price -->
                <div class="summary-panel">
                    <div class="summary-sticky">
                        <div class="summary-header">
                            <h3 class="summary-title">Récapitulatif</h3>
                            <div class="summary-badge">Configuration en temps réel</div>
                        </div>

                        <div class="price-display">
                            <div class="price-label">Prix Total</div>
                            <div class="price-amount" id="totalPrice">$249</div>
                            <div class="price-note">Paiement unique</div>
                        </div>

                        <div class="summary-details">
                            <h4 class="details-heading">Votre Configuration</h4>
                            <div class="detail-item">
                                <span class="detail-label">Type de compte</span>
                                <span class="detail-value" id="summaryType">2 Steps</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Montant</span>
                                <span class="detail-value" id="summarySize">$10,000</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Système de risque</span>
                                <span class="detail-value" id="summaryRisk">Trailing Drawdown</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Target de profit</span>
                                <span class="detail-value" id="summaryTarget">10%</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Drawdown max</span>
                                <span class="detail-value" id="summaryDrawdown">5%</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Consistency</span>
                                <span class="detail-value" id="summaryConsistency">Aucune</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Profit split</span>
                                <span class="detail-value" id="summarySplit">80%</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Jours évaluation</span>
                                <span class="detail-value" id="summaryEvalDays">5 jours min</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Jours funded</span>
                                <span class="detail-value" id="summaryFundedDays">3 jours min</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Levier</span>
                                <span class="detail-value" id="summaryLeverage">1:100</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Lot maximum</span>
                                <span class="detail-value" id="summaryLotSize">5 lots</span>
                            </div>
                        </div>

                        <button class="btn-primary btn-full btn-large" id="checkoutBtn">
                            <span>Procéder au Paiement</span>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M7.5 15L12.5 10L7.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </button>

                        <div class="trust-badges">
                            <div class="trust-item">
                                <span class="trust-icon">🔒</span>
                                <span class="trust-text">Paiement sécurisé</span>
                            </div>
                            <div class="trust-item">
                                <span class="trust-icon">✓</span>
                                <span class="trust-text">Accès immédiat</span>
                            </div>
                            <div class="trust-item">
                                <span class="trust-icon">💬</span>
                                <span class="trust-text">Support 24/7</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="js/configurator.js"></script>
</body>
</html>
```

---

## ✅ Fichier `configurator.php` Terminé !

Maintenant tu as :
```
✅ public/index.php (380 lignes)
✅ public/configurator.php (330 lignes)
