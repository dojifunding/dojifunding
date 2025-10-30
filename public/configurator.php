<?php
/**
 * Doji Funding - Configurateur Personnalisé
 * Interface de configuration d'évaluation en temps réel avec système de presets
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
    <meta name="description" content="Créez votre évaluation de trading personnalisée avec notre configurateur avancé">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="configurator-page">
    <!-- Header -->
    <header class="header header-compact">
        <nav class="nav-container">
            <div class="logo">
                <a href="index.php">
                    <h1><span class="metal-text">D</span><span class="logo-accent">OJI</span> <span class="logo-accent">FUNDING</span></h1>
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
            
            <!-- ========================================
                 SECTION PRESETS
                 ======================================== -->
            <div class="presets-section">
                <div class="presets-header">
                    <h2 class="presets-title">🎯 Configurations Rapides</h2>
                    <p class="presets-subtitle">Chargez une configuration prédéfinie ou créez la vôtre</p>
                </div>

                <!-- Tabs Navigation -->
                <div class="presets-tabs">
                    <button class="preset-tab active" data-tab="propfirms">
                        <span class="tab-icon">🏆</span>
                        <span class="tab-name">PropFirms Populaires</span>
                    </button>
                    <button class="preset-tab" data-tab="styles">
                        <span class="tab-icon">📊</span>
                        <span class="tab-name">Style de Trading</span>
                    </button>
                    <button class="preset-tab" data-tab="budget">
                        <span class="tab-icon">💰</span>
                        <span class="tab-name">Par Budget</span>
                    </button>
                    <button class="preset-tab" data-tab="custom">
                        <span class="tab-icon">⭐</span>
                        <span class="tab-name">Mes Presets</span>
                    </button>
                </div>

                <!-- Tab Content: PropFirms -->
                <div class="presets-content active" id="tab-propfirms">
                    <div class="presets-grid">
                        <div class="preset-card" onclick="configurator.loadPreset('funds-trade-max')">
                            <div class="preset-emoji">🏆</div>
                            <h3 class="preset-name">Funds Trade Max</h3>
                            <p class="preset-desc">Style FTMO - Le standard de l'industrie</p>
                            <div class="preset-tags">
                                <span class="tag">Populaire</span>
                                <span class="tag">Standard</span>
                            </div>
                        </div>

                        <div class="preset-card" onclick="configurator.loadPreset('five-star-traders')">
                            <div class="preset-emoji">⭐</div>
                            <h3 class="preset-name">Five Star Traders</h3>
                            <p class="preset-desc">Style The5ers - Pour traders agressifs</p>
                            <div class="preset-tags">
                                <span class="tag">Agressif</span>
                                <span class="tag">100% Split</span>
                            </div>
                        </div>

                        <div class="preset-card" onclick="configurator.loadPreset('next-level-funding')">
                            <div class="preset-emoji">🚀</div>
                            <h3 class="preset-name">Next Level Funding</h3>
                            <p class="preset-desc">Style FundedNext - Rapide et flexible</p>
                            <div class="preset-tags">
                                <span class="tag">Instant</span>
                                <span class="tag">Flexible</span>
                            </div>
                        </div>

                        <div class="preset-card" onclick="configurator.loadPreset('forex-masters')">
                            <div class="preset-emoji">💎</div>
                            <h3 class="preset-name">Forex Masters</h3>
                            <p class="preset-desc">Style MyForexFunds - Pour les pros</p>
                            <div class="preset-tags">
                                <span class="tag">Pro</span>
                                <span class="tag">Gros compte</span>
                            </div>
                        </div>

                        <div class="preset-card" onclick="configurator.loadPreset('fx-infinity')">
                            <div class="preset-emoji">♾️</div>
                            <h3 class="preset-name">FX Infinity</h3>
                            <p class="preset-desc">Style FXIFY - Liberté maximale</p>
                            <div class="preset-tags">
                                <span class="tag">Débutant</span>
                                <span class="tag">Liberal</span>
                            </div>
                        </div>

                        <div class="preset-card" onclick="configurator.loadPreset('elite-eight')">
                            <div class="preset-emoji">👑</div>
                            <h3 class="preset-name">Elite Eight</h3>
                            <p class="preset-desc">Style E8 Funding - Pour l'élite</p>
                            <div class="preset-tags">
                                <span class="tag">Élite</span>
                                <span class="tag">Strict</span>
                            </div>
                        </div>

                        <div class="preset-card" onclick="configurator.loadPreset('true-traders')">
                            <div class="preset-emoji">✅</div>
                            <h3 class="preset-name">True Traders</h3>
                            <p class="preset-desc">Style True Forex Funds - Simplicité</p>
                            <div class="preset-tags">
                                <span class="tag">Simple</span>
                                <span class="tag">Accessible</span>
                            </div>
                        </div>

                        <div class="preset-card" onclick="configurator.loadPreset('peak-traders')">
                            <div class="preset-emoji">⛰️</div>
                            <h3 class="preset-name">Peak Traders</h3>
                            <p class="preset-desc">Style Apex - Sommet de performance</p>
                            <div class="preset-tags">
                                <span class="tag">Performance</span>
                                <span class="tag">Équilibré</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab Content: Trading Styles -->
                <div class="presets-content" id="tab-styles">
                    <div class="presets-grid">
                        <div class="preset-card" onclick="configurator.loadPreset('scalper-pro')">
                            <div class="preset-emoji">⚡</div>
                            <h3 class="preset-name">Scalper Pro</h3>
                            <p class="preset-desc">Optimisé pour le scalping haute fréquence</p>
                            <div class="preset-tags">
                                <span class="tag">Scalping</span>
                                <span class="tag">Rapide</span>
                            </div>
                        </div>

                        <div class="preset-card" onclick="configurator.loadPreset('swing-master')">
                            <div class="preset-emoji">📊</div>
                            <h3 class="preset-name">Swing Master</h3>
                            <p class="preset-desc">Parfait pour le swing trading</p>
                            <div class="preset-tags">
                                <span class="tag">Swing</span>
                                <span class="tag">Patient</span>
                            </div>
                        </div>

                        <div class="preset-card" onclick="configurator.loadPreset('day-trader')">
                            <div class="preset-emoji">🌅</div>
                            <h3 class="preset-name">Day Trader</h3>
                            <p class="preset-desc">Configuration pour le day trading classique</p>
                            <div class="preset-tags">
                                <span class="tag">Day Trading</span>
                                <span class="tag">Régulier</span>
                            </div>
                        </div>

                        <div class="preset-card" onclick="configurator.loadPreset('conservative')">
                            <div class="preset-emoji">🛡️</div>
                            <h3 class="preset-name">Trader Conservateur</h3>
                            <p class="preset-desc">Risque minimal, progression stable</p>
                            <div class="preset-tags">
                                <span class="tag">Conservateur</span>
                                <span class="tag">Sécurisé</span>
                            </div>
                        </div>

                        <div class="preset-card" onclick="configurator.loadPreset('aggressive')">
                            <div class="preset-emoji">🔥</div>
                            <h3 class="preset-name">Trader Agressif</h3>
                            <p class="preset-desc">Risque élevé, profit maximum</p>
                            <div class="preset-tags">
                                <span class="tag">Agressif</span>
                                <span class="tag">Profit Max</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab Content: Budget -->
                <div class="presets-content" id="tab-budget">
                    <div class="presets-grid">
                        <div class="preset-card" onclick="configurator.loadPreset('starter-pack')">
                            <div class="preset-emoji">🌱</div>
                            <h3 class="preset-name">Pack Débutant</h3>
                            <p class="preset-desc">Petit budget, parfait pour commencer - $2K</p>
                            <div class="preset-tags">
                                <span class="tag">Débutant</span>
                                <span class="tag">$2K</span>
                            </div>
                        </div>

                        <div class="preset-card" onclick="configurator.loadPreset('intermediate')">
                            <div class="preset-emoji">📈</div>
                            <h3 class="preset-name">Pack Intermédiaire</h3>
                            <p class="preset-desc">Budget moyen pour expérimentés - $25K</p>
                            <div class="preset-tags">
                                <span class="tag">Intermédiaire</span>
                                <span class="tag">$25K</span>
                            </div>
                        </div>

                        <div class="preset-card" onclick="configurator.loadPreset('pro-package')">
                            <div class="preset-emoji">💼</div>
                            <h3 class="preset-name">Pack Professionnel</h3>
                            <p class="preset-desc">Gros budget pour professionnels - $100K</p>
                            <div class="preset-tags">
                                <span class="tag">Pro</span>
                                <span class="tag">$100K</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab Content: Custom Presets -->
                <div class="presets-content" id="tab-custom">
                    <div class="custom-presets-header">
                        <p class="custom-presets-info">
                            💡 Configurez votre compte parfait, puis sauvegardez-le pour le réutiliser plus tard !
                        </p>
                        <button class="btn-primary" id="savePresetBtn">
                            <span>💾</span>
                            <span>Sauvegarder la Configuration Actuelle</span>
                        </button>
                    </div>
                    <div class="presets-grid" id="customPresetsContainer">
                        <p class="no-presets">Aucun preset personnalisé sauvegardé</p>
                    </div>
                </div>
            </div>

            <!-- Boutons d'Actions Rapides -->
            <div class="quick-actions">
                <button class="action-btn" id="shareConfigBtn">
                    <span class="action-icon">🔗</span>
                    <span class="action-text">Partager cette Configuration</span>
                </button>
                <button class="action-btn" id="resetConfigBtn">
                    <span class="action-icon">🔄</span>
                    <span class="action-text">Réinitialiser</span>
                </button>
            </div>

            <!-- FIN SECTION PRESETS -->
            
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
                            <div class="price-original" id="originalPrice" style="display: none;">
                                <del>$299</del>
                            </div>
                            <div class="price-note">Paiement unique</div>
                        </div>

                        <!-- Code Promo Section -->
                        <div class="promo-section">
                            <label class="promo-label">
                                <span class="promo-icon">🎟️</span>
                                <span>Code Promo</span>
                            </label>
                            <div class="promo-input-group">
                                <input 
                                    type="text" 
                                    id="promoCode" 
                                    class="promo-input" 
                                    placeholder="Entrez votre code"
                                    maxlength="20"
                                >
                                <button type="button" id="applyPromoBtn" class="btn-promo">
                                    Appliquer
                                </button>
                            </div>
                            <div class="promo-message" id="promoMessage"></div>
                            <div class="promo-applied" id="promoApplied" style="display: none;">
                                <div class="promo-applied-content">
                                    <span class="promo-applied-icon">✓</span>
                                    <span class="promo-applied-text">
                                        <strong id="appliedPromoName">WELCOME10</strong>
                                        <span id="appliedPromoDiscount">-10%</span>
                                    </span>
                                    <button type="button" id="removePromoBtn" class="btn-promo-remove">
                                        ✕
                                    </button>
                                </div>
                            </div>
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

    <!-- Scripts -->
    <script src="js/presets.js"></script>
    <script src="js/configurator.js"></script>
    <script>
        // Script pour les tabs et actions
        document.addEventListener('DOMContentLoaded', () => {
            // Gestion des tabs
            document.querySelectorAll('.preset-tab').forEach(tab => {
                tab.addEventListener('click', () => {
                    // Désactiver tous les tabs
                    document.querySelectorAll('.preset-tab').forEach(t => t.classList.remove('active'));
                    document.querySelectorAll('.presets-content').forEach(c => c.classList.remove('active'));
                    
                    // Activer le tab cliqué
                    tab.classList.add('active');
                    const tabName = tab.dataset.tab;
                    document.getElementById(`tab-${tabName}`).classList.add('active');
                });
            });

            // Bouton Sauvegarder Preset
            document.getElementById('savePresetBtn').addEventListener('click', () => {
                const name = prompt('Donnez un nom à ce preset :');
                if (name && name.trim()) {
                    configurator.saveCustomPreset(name.trim());
                }
            });

            // Bouton Partager
            document.getElementById('shareConfigBtn').addEventListener('click', () => {
                configurator.generateShareLink();
            });

            // Bouton Réinitialiser
            document.getElementById('resetConfigBtn').addEventListener('click', () => {
                if (confirm('Réinitialiser la configuration ?')) {
                    location.reload();
                }
            });
        });
    </script>
</body>
</html>
