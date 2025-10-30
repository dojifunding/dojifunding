/**
 * Doji Funding - Configurateur JavaScript
 * Calcul dynamique des prix et mise à jour en temps réel
 */

class DojiConfigurator {
    constructor() {
        this.config = {
            accountType: '2steps',
            accountSize: 10000,
            riskSystem: 'trailing',
            profitTarget: 10,
            maxDrawdown: 5,
            consistency: 'none',
            profitSplit: 80,
            evalDays: 5,
            fundedDays: 3,
            leverage: 100,
            maxLotSize: 5
        };
        
        // Prix de base pour chaque type de compte (pour 10K)
        this.basePrices = {
            '2steps': 100,
            '3steps': 120,
            'instant': 500
        };
        
        this.init();
    }
    
    init() {
        this.bindEvents();
        this.loadFromURL(); // Charger depuis l'URL si présent
        this.updateSummary();
        this.calculatePrice();
        this.renderCustomPresets(); // Afficher les presets personnalisés
    }
    
    bindEvents() {
        // Type de compte
        document.querySelectorAll('.type-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                document.querySelectorAll('.type-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                this.config.accountType = btn.dataset.type;
                this.updateSummary();
                this.calculatePrice();
            });
        });
        
        // Account Size
        const accountSizeSlider = document.getElementById('accountSize');
        accountSizeSlider.addEventListener('input', (e) => {
            this.config.accountSize = parseInt(e.target.value);
            document.getElementById('accountSizeValue').textContent = this.formatCurrency(this.config.accountSize);
            document.getElementById('summarySize').textContent = this.formatCurrency(this.config.accountSize);
            this.calculatePrice();
        });
        
        // Risk System
        document.querySelectorAll('input[name="riskSystem"]').forEach(radio => {
            radio.addEventListener('change', (e) => {
                this.config.riskSystem = e.target.value;
                const riskNames = {
                    'trailing': 'Trailing Drawdown',
                    'eod': 'EOD Drawdown',
                    'static': 'Static Drawdown'
                };
                document.getElementById('summaryRisk').textContent = riskNames[e.target.value];
                this.calculatePrice();
            });
        });
        
        // Profit Target
        const targetSlider = document.getElementById('profitTarget');
        targetSlider.addEventListener('input', (e) => {
            this.config.profitTarget = parseInt(e.target.value);
            document.getElementById('targetValue').textContent = `${this.config.profitTarget}%`;
            document.getElementById('summaryTarget').textContent = `${this.config.profitTarget}%`;
            this.calculatePrice();
        });
        
        // Max Drawdown
        const drawdownSlider = document.getElementById('maxDrawdown');
        drawdownSlider.addEventListener('input', (e) => {
            this.config.maxDrawdown = parseInt(e.target.value);
            document.getElementById('drawdownValue').textContent = `${this.config.maxDrawdown}%`;
            document.getElementById('summaryDrawdown').textContent = `${this.config.maxDrawdown}%`;
            this.calculatePrice();
        });
        
        // Consistency
        const consistencySelect = document.getElementById('consistency');
        consistencySelect.addEventListener('change', (e) => {
            this.config.consistency = e.target.value;
            const consistencyText = e.target.value === 'none' ? 'Aucune' : `${e.target.value}% max`;
            document.getElementById('summaryConsistency').textContent = consistencyText;
            this.calculatePrice();
        });
        
        // Profit Split
        const splitSlider = document.getElementById('profitSplit');
        splitSlider.addEventListener('input', (e) => {
            this.config.profitSplit = parseInt(e.target.value);
            document.getElementById('splitValue').textContent = `${this.config.profitSplit}%`;
            document.getElementById('summarySplit').textContent = `${this.config.profitSplit}%`;
            this.calculatePrice();
        });
        
        // Eval Days
        const evalDaysSlider = document.getElementById('evalDays');
        evalDaysSlider.addEventListener('input', (e) => {
            this.config.evalDays = parseInt(e.target.value);
            const daysText = this.config.evalDays === 0 ? 'Aucun' : `${this.config.evalDays} jours min`;
            document.getElementById('evalDaysValue').textContent = daysText;
            document.getElementById('summaryEvalDays').textContent = daysText;
            this.calculatePrice();
        });
        
        // Funded Days
        const fundedDaysSlider = document.getElementById('fundedDays');
        fundedDaysSlider.addEventListener('input', (e) => {
            this.config.fundedDays = parseInt(e.target.value);
            const daysText = this.config.fundedDays === 0 ? 'Aucun' : `${this.config.fundedDays} jours min`;
            document.getElementById('fundedDaysValue').textContent = daysText;
            document.getElementById('summaryFundedDays').textContent = daysText;
            this.calculatePrice();
        });
        
        // Leverage
        const leverageSelect = document.getElementById('leverage');
        leverageSelect.addEventListener('change', (e) => {
            this.config.leverage = parseInt(e.target.value);
            document.getElementById('leverageValue').textContent = `1:${this.config.leverage}`;
            document.getElementById('summaryLeverage').textContent = `1:${this.config.leverage}`;
            this.calculatePrice();
        });
        
        // Max Lot Size
        const lotSizeSlider = document.getElementById('maxLotSize');
        lotSizeSlider.addEventListener('input', (e) => {
            this.config.maxLotSize = parseInt(e.target.value);
            document.getElementById('lotSizeValue').textContent = `${this.config.maxLotSize} lots`;
            document.getElementById('summaryLotSize').textContent = `${this.config.maxLotSize} lots`;
            this.calculatePrice();
        });
        
        // Checkout Button
        document.getElementById('checkoutBtn').addEventListener('click', () => {
            this.handleCheckout();
        });
    }
    
    calculatePrice() {
        let basePrice = this.basePrices[this.config.accountType];
        
        // Facteur multiplicateur pour la taille du compte
        const sizeMultiplier = this.config.accountSize / 10000;
        let price = basePrice * sizeMultiplier;
        
        // Risk System (impact multiplicatif)
        const riskMultipliers = {
            'trailing': 1.0,
            'eod': 1.15,
            'static': 1.35
        };
        price *= riskMultipliers[this.config.riskSystem];
        
        // Profit Target (plus c'est élevé, moins c'est cher)
        const targetFactor = 1.5 - (this.config.profitTarget / 50);
        price *= Math.max(0.6, Math.min(1.5, targetFactor));
        
        // Max Drawdown (plus c'est élevé, plus c'est cher)
        const drawdownFactor = 0.7 + (this.config.maxDrawdown / 50);
        price *= Math.max(0.7, Math.min(1.6, drawdownFactor));
        
        // Consistency (moins de consistency = moins cher)
        const consistencyMultipliers = {
            'none': 0.85,
            '50': 0.9,
            '40': 0.95,
            '30': 1.0,
            '20': 1.05,
            '10': 1.1
        };
        price *= consistencyMultipliers[this.config.consistency] || 1.0;
        
        // Profit Split (plus c'est élevé, plus c'est cher)
        const splitFactor = 1 + ((this.config.profitSplit - 50) / 100);
        price *= splitFactor;
        
        // Eval Days (plus de jours requis = moins cher)
        const evalDaysFactor = 1 - (this.config.evalDays * 0.015);
        price *= Math.max(0.7, evalDaysFactor);
        
        // Funded Days (plus de jours requis = moins cher)
        const fundedDaysFactor = 1 - (this.config.fundedDays * 0.01);
        price *= Math.max(0.8, fundedDaysFactor);
        
        // Leverage (plus c'est élevé, moins c'est cher)
        const leverageFactors = {
            1: 2.0,
            10: 1.5,
            20: 1.3,
            30: 1.2,
            50: 1.1,
            100: 1.0,
            200: 0.9,
            300: 0.8,
            400: 0.7
        };
        price *= leverageFactors[this.config.leverage] || 1.0;
        
        // Max Lot Size (plus de lots = plus cher)
        const lotSizeFactor = 1 + ((this.config.maxLotSize - 1) * 0.05);
        price *= lotSizeFactor;
        
        // Arrondir au dollar supérieur
        price = Math.ceil(price);
        
        // Mettre à jour l'affichage avec animation
        this.animatePriceChange(price);
    }
    
    animatePriceChange(newPrice) {
        const priceElement = document.getElementById('totalPrice');
        const currentPrice = parseInt(priceElement.textContent.replace(/[^0-9]/g, ''));
        
        if (currentPrice === newPrice) return;
        
        // Animation du changement de prix
        priceElement.style.transform = 'scale(1.1)';
        priceElement.style.color = 'var(--accent)';
        
        setTimeout(() => {
            priceElement.textContent = this.formatCurrency(newPrice);
            priceElement.style.transform = 'scale(1)';
            priceElement.style.color = 'var(--white)';
        }, 150);
    }
    
    updateSummary() {
        const typeNames = {
            '2steps': '2 Steps',
            '3steps': '3 Steps',
            'instant': 'Instant Funding'
        };
        document.getElementById('summaryType').textContent = typeNames[this.config.accountType];
    }
    
    formatCurrency(amount) {
        return new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(amount);
    }
    
    handleCheckout() {
        // Sauvegarder la configuration dans sessionStorage
        sessionStorage.setItem('dojiConfig', JSON.stringify(this.config));
        
        // Animation de chargement
        const btn = document.getElementById('checkoutBtn');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<span>Chargement...</span>';
        btn.disabled = true;
        
        // Simuler une redirection
        setTimeout(() => {
            alert('Redirection vers la page de paiement...\n\nConfiguration sauvegardée !');
            btn.innerHTML = originalText;
            btn.disabled = false;
        }, 1500);
    }
    
    // ========================================
    // SYSTÈME DE PRESETS
    // ========================================
    
    // Charger un preset
    loadPreset(presetId) {
        // Chercher dans les presets publics
        let preset = PRESET_CONFIGS[presetId];
        
        // Si pas trouvé, chercher dans les presets personnalisés
        if (!preset) {
            const customPresets = this.getCustomPresets();
            preset = customPresets[presetId];
        }
        
        if (!preset) {
            console.error('Preset non trouvé:', presetId);
            return;
        }
        
        // Appliquer la configuration
        this.config = { ...preset.config };
        
        // Mettre à jour l'interface
        this.updateUIFromConfig();
        this.updateSummary();
        this.calculatePrice();
        
        // Notification
        this.showNotification(`✅ Preset "${preset.name}" chargé !`);
    }
    
    // Mettre à jour l'UI depuis la config
    updateUIFromConfig() {
        // Type de compte
        document.querySelectorAll('.type-btn').forEach(btn => {
            btn.classList.toggle('active', btn.dataset.type === this.config.accountType);
        });
        
        // Account Size
        document.getElementById('accountSize').value = this.config.accountSize;
        document.getElementById('accountSizeValue').textContent = this.formatCurrency(this.config.accountSize);
        document.getElementById('summarySize').textContent = this.formatCurrency(this.config.accountSize);
        
        // Risk System
        document.querySelector(`input[name="riskSystem"][value="${this.config.riskSystem}"]`).checked = true;
        const riskNames = {
            'trailing': 'Trailing Drawdown',
            'eod': 'EOD Drawdown',
            'static': 'Static Drawdown'
        };
        document.getElementById('summaryRisk').textContent = riskNames[this.config.riskSystem];
        
        // Sliders
        document.getElementById('profitTarget').value = this.config.profitTarget;
        document.getElementById('targetValue').textContent = `${this.config.profitTarget}%`;
        document.getElementById('summaryTarget').textContent = `${this.config.profitTarget}%`;
        
        document.getElementById('maxDrawdown').value = this.config.maxDrawdown;
        document.getElementById('drawdownValue').textContent = `${this.config.maxDrawdown}%`;
        document.getElementById('summaryDrawdown').textContent = `${this.config.maxDrawdown}%`;
        
        document.getElementById('profitSplit').value = this.config.profitSplit;
        document.getElementById('splitValue').textContent = `${this.config.profitSplit}%`;
        document.getElementById('summarySplit').textContent = `${this.config.profitSplit}%`;
        
        document.getElementById('evalDays').value = this.config.evalDays;
        const evalDaysText = this.config.evalDays === 0 ? 'Aucun' : `${this.config.evalDays} jours min`;
        document.getElementById('evalDaysValue').textContent = evalDaysText;
        document.getElementById('summaryEvalDays').textContent = evalDaysText;
        
        document.getElementById('fundedDays').value = this.config.fundedDays;
        const fundedDaysText = this.config.fundedDays === 0 ? 'Aucun' : `${this.config.fundedDays} jours min`;
        document.getElementById('fundedDaysValue').textContent = fundedDaysText;
        document.getElementById('summaryFundedDays').textContent = fundedDaysText;
        
        document.getElementById('maxLotSize').value = this.config.maxLotSize;
        document.getElementById('lotSizeValue').textContent = `${this.config.maxLotSize} lots`;
        document.getElementById('summaryLotSize').textContent = `${this.config.maxLotSize} lots`;
        
        // Selects
        document.getElementById('consistency').value = this.config.consistency;
        const consistencyText = this.config.consistency === 'none' ? 'Aucune' : `${this.config.consistency}% max`;
        document.getElementById('summaryConsistency').textContent = consistencyText;
        
        document.getElementById('leverage').value = this.config.leverage;
        document.getElementById('leverageValue').textContent = `1:${this.config.leverage}`;
        document.getElementById('summaryLeverage').textContent = `1:${this.config.leverage}`;
    }
    
    // Sauvegarder un preset personnalisé
    saveCustomPreset(name) {
        const customPresets = this.getCustomPresets();
        const presetId = 'custom-' + Date.now();
        
        customPresets[presetId] = {
            name: name,
            emoji: '⭐',
            description: 'Configuration personnalisée',
            config: { ...this.config },
            createdAt: new Date().toISOString()
        };
        
        localStorage.setItem('dojiCustomPresets', JSON.stringify(customPresets));
        this.showNotification(`✅ Preset "${name}" sauvegardé !`);
        this.renderCustomPresets();
    }
    
    // Récupérer les presets personnalisés
    getCustomPresets() {
        const stored = localStorage.getItem('dojiCustomPresets');
        return stored ? JSON.parse(stored) : {};
    }
    
    // Supprimer un preset personnalisé
    deleteCustomPreset(presetId) {
        if (!confirm('Êtes-vous sûr de vouloir supprimer ce preset ?')) {
            return;
        }
        
        const customPresets = this.getCustomPresets();
        delete customPresets[presetId];
        localStorage.setItem('dojiCustomPresets', JSON.stringify(customPresets));
        this.renderCustomPresets();
        this.showNotification('🗑️ Preset supprimé');
    }
    
    // Générer un lien de partage
    generateShareLink() {
        const params = new URLSearchParams({
            type: this.config.accountType,
            size: this.config.accountSize,
            risk: this.config.riskSystem,
            target: this.config.profitTarget,
            dd: this.config.maxDrawdown,
            cons: this.config.consistency,
            split: this.config.profitSplit,
            eval: this.config.evalDays,
            funded: this.config.fundedDays,
            lev: this.config.leverage,
            lot: this.config.maxLotSize
        });
        
        const baseUrl = window.location.origin + window.location.pathname;
        const shareUrl = `${baseUrl}?${params.toString()}`;
        
        // Copier dans le presse-papier
        navigator.clipboard.writeText(shareUrl).then(() => {
            this.showNotification('🔗 Lien copié dans le presse-papier !');
        }).catch(() => {
            // Fallback si clipboard API ne fonctionne pas
            prompt('Copiez ce lien :', shareUrl);
        });
        
        return shareUrl;
    }
    
    // Charger depuis l'URL
    loadFromURL() {
        const params = new URLSearchParams(window.location.search);
        
        if (params.has('type')) {
            this.config = {
                accountType: params.get('type') || '2steps',
                accountSize: parseInt(params.get('size')) || 10000,
                riskSystem: params.get('risk') || 'trailing',
                profitTarget: parseInt(params.get('target')) || 10,
                maxDrawdown: parseInt(params.get('dd')) || 5,
                consistency: params.get('cons') || 'none',
                profitSplit: parseInt(params.get('split')) || 80,
                evalDays: parseInt(params.get('eval')) || 5,
                fundedDays: parseInt(params.get('funded')) || 3,
                leverage: parseInt(params.get('lev')) || 100,
                maxLotSize: parseInt(params.get('lot')) || 5
            };
            
            this.updateUIFromConfig();
            this.updateSummary();
            this.calculatePrice();
            this.showNotification('✅ Configuration chargée depuis le lien !');
        }
    }
    
    // Afficher une notification
    showNotification(message) {
        // Créer l'élément de notification
        const notification = document.createElement('div');
        notification.className = 'preset-notification';
        notification.textContent = message;
        notification.style.cssText = `
            position: fixed;
            top: 100px;
            right: 20px;
            background: var(--gradient-primary);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-xl);
            z-index: 10000;
            animation: slideInRight 0.3s ease;
        `;
        
        document.body.appendChild(notification);
        
        // Supprimer après 3 secondes
        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translateX(100px)';
            notification.style.transition = 'all 0.3s ease';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }
    
    // Rendre les presets personnalisés dans l'UI
    renderCustomPresets() {
        const container = document.getElementById('customPresetsContainer');
        if (!container) return;
        
        const customPresets = this.getCustomPresets();
        const presetKeys = Object.keys(customPresets);
        
        if (presetKeys.length === 0) {
            container.innerHTML = '<p class="no-presets">Aucun preset personnalisé sauvegardé</p>';
            return;
        }
        
        container.innerHTML = presetKeys.map(presetId => {
            const preset = customPresets[presetId];
            return `
                <div class="preset-card custom-preset">
                    <div class="preset-header">
                        <span class="preset-emoji">${preset.emoji}</span>
                        <h4 class="preset-name">${preset.name}</h4>
                    </div>
                    <p class="preset-desc">${preset.description}</p>
                    <div class="preset-actions">
                        <button class="btn-secondary btn-small" onclick="configurator.loadPreset('${presetId}')">
                            Charger
                        </button>
                        <button class="btn-danger btn-small" onclick="configurator.deleteCustomPreset('${presetId}')">
                            🗑️
                        </button>
                    </div>
                </div>
            `;
        }).join('');
    }
}

// Variable globale pour accès externe
let configurator;

// ============================================
// SYSTÈME DE CODE PROMO
// ============================================

const PromoCodes = {
    // Codes promo disponibles
    codes: {
        'WELCOME10': {
            type: 'percentage',
            value: 10,
            description: 'Réduction de bienvenue'
        },
        'LAUNCH50': {
            type: 'percentage',
            value: 50,
            description: 'Offre de lancement'
        },
        'FIRST20': {
            type: 'percentage',
            value: 20,
            description: 'Première évaluation'
        },
        'VIP30': {
            type: 'percentage',
            value: 30,
            description: 'Code VIP'
        },
        'SAVE15': {
            type: 'percentage',
            value: 15,
            description: 'Économisez maintenant'
        },
        'TRADER25': {
            type: 'percentage',
            value: 25,
            description: 'Offre trader'
        },
        'BLACKFRIDAY': {
            type: 'percentage',
            value: 40,
            description: 'Black Friday'
        },
        'NEWYEAR': {
            type: 'percentage',
            value: 35,
            description: 'Nouvel An'
        },
        'FREE50': {
            type: 'fixed',
            value: 50,
            description: '50$ de réduction'
        },
        'SAVE100': {
            type: 'fixed',
            value: 100,
            description: '100$ de réduction'
        }
    },

    currentPromo: null,
    originalPrice: 0,

    init() {
        this.originalPrice = configurator.calculatePrice();
        
        // Event listener sur le bouton Appliquer
        const applyBtn = document.getElementById('applyPromoBtn');
        if (applyBtn) {
            applyBtn.addEventListener('click', () => {
                this.applyPromo();
            });
        }

        // Event listener sur la touche Entrée dans l'input
        const promoInput = document.getElementById('promoCode');
        if (promoInput) {
            promoInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    this.applyPromo();
                }
            });
        }

        // Event listener sur le bouton Retirer
        const removeBtn = document.getElementById('removePromoBtn');
        if (removeBtn) {
            removeBtn.addEventListener('click', () => {
                this.removePromo();
            });
        }
    },

    applyPromo() {
        const input = document.getElementById('promoCode');
        const code = input.value.trim().toUpperCase();
        
        if (!code) {
            this.showMessage('Veuillez entrer un code promo', 'error');
            return;
        }

        const promo = this.codes[code];
        
        if (!promo) {
            this.showMessage('❌ Code promo invalide', 'error');
            input.value = '';
            return;
        }

        // Sauvegarder le promo actuel
        this.currentPromo = {
            code: code,
            ...promo
        };

        // Afficher le promo appliqué
        this.showAppliedPromo();

        // Recalculer le prix
        this.updatePrice();

        // Message de succès
        const discount = promo.type === 'percentage' 
            ? `${promo.value}%` 
            : `$${promo.value}`;
        this.showMessage(`✓ Code "${code}" appliqué ! ${discount} de réduction`, 'success');

        // Vider l'input
        input.value = '';
    },

    removePromo() {
        this.currentPromo = null;
        
        // Cacher la section "promo appliqué"
        const appliedDiv = document.getElementById('promoApplied');
        if (appliedDiv) {
            appliedDiv.style.display = 'none';
        }
        
        // Cacher le prix original
        const originalPriceEl = document.getElementById('originalPrice');
        if (originalPriceEl) {
            originalPriceEl.style.display = 'none';
        }

        // Recalculer le prix
        this.updatePrice();

        // Message
        this.showMessage('Code promo retiré', 'error');
    },

    showAppliedPromo() {
        const appliedDiv = document.getElementById('promoApplied');
        const nameSpan = document.getElementById('appliedPromoName');
        const discountSpan = document.getElementById('appliedPromoDiscount');

        if (!appliedDiv || !nameSpan || !discountSpan) return;

        nameSpan.textContent = this.currentPromo.code;
        
        if (this.currentPromo.type === 'percentage') {
            discountSpan.textContent = `-${this.currentPromo.value}%`;
        } else {
            discountSpan.textContent = `-$${this.currentPromo.value}`;
        }

        appliedDiv.style.display = 'block';
    },

updatePrice() {
    // Vérifier que configurator existe et a la méthode calculatePrice
    if (!configurator || typeof configurator.calculatePrice !== 'function') {
        console.error('Configurator non initialisé');
        return;
    }

    // Recalculer le prix de base
    const basePrice = configurator.calculatePrice();
    
    // Vérifier que le prix est valide
    if (isNaN(basePrice) || basePrice <= 0) {
        console.error('Prix de base invalide:', basePrice);
        return;
    }

    this.originalPrice = basePrice;

    let finalPrice = basePrice;
    const originalPriceEl = document.getElementById('originalPrice');
    const priceEl = document.getElementById('totalPrice');

    if (!priceEl) return;

    if (this.currentPromo) {
        // Appliquer la réduction
        if (this.currentPromo.type === 'percentage') {
            finalPrice = basePrice * (1 - this.currentPromo.value / 100);
        } else {
            finalPrice = basePrice - this.currentPromo.value;
        }

        // Afficher le prix original barré
        if (originalPriceEl) {
            originalPriceEl.innerHTML = `<del>$${Math.round(basePrice)}</del>`;
            originalPriceEl.style.display = 'block';
        }
    } else {
        if (originalPriceEl) {
            originalPriceEl.style.display = 'none';
        }
    }

    // S'assurer que le prix ne soit jamais négatif
    finalPrice = Math.max(0, finalPrice);

    // Vérifier que le prix final est valide
    if (isNaN(finalPrice)) {
        console.error('Prix final invalide');
        return;
    }

    // Mettre à jour l'affichage avec animation
    priceEl.classList.add('updating');
    
    setTimeout(() => {
        priceEl.textContent = '$' + Math.round(finalPrice);
        priceEl.classList.remove('updating');
    }, 150);
}

    showMessage(message, type) {
        const messageEl = document.getElementById('promoMessage');
        if (!messageEl) return;

        messageEl.textContent = message;
        messageEl.className = `promo-message ${type}`;

        // Effacer le message après 3 secondes
        setTimeout(() => {
            messageEl.textContent = '';
            messageEl.className = 'promo-message';
        }, 3000);
    },

    // Méthode pour obtenir le prix final avec promo
    getFinalPrice() {
        const basePrice = configurator.calculatePrice();
        
        if (!this.currentPromo) {
            return basePrice;
        }

        let finalPrice = basePrice;
        
        if (this.currentPromo.type === 'percentage') {
            finalPrice = basePrice * (1 - this.currentPromo.value / 100);
        } else {
            finalPrice = basePrice - this.currentPromo.value;
        }

        return Math.max(0, Math.round(finalPrice));
    }
};

// Initialiser le configurateur et le système promo au chargement de la page
document.addEventListener('DOMContentLoaded', () => {
    configurator = new DojiConfigurator();
    
    // Initialiser le système de promo après un court délai
    setTimeout(() => {
        PromoCodes.init();
    }, 100);
});
