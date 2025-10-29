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
        this.updateSummary();
        this.calculatePrice();
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
}

// Initialiser le configurateur au chargement de la page
document.addEventListener('DOMContentLoaded', () => {
    new DojiConfigurator();
});
