/**
 * Doji Funding - Presets de Configuration
 * Configurations prédéfinies inspirées des PropFirms populaires
 */

const PRESET_CONFIGS = {
    // ========================================
    // PRESETS INSPIRÉS DES PROPFIRMS CONNUES
    // ========================================
    
    'funds-trade-max': {
        name: 'Funds Trade Max',
        emoji: '🏆',
        description: 'Configuration inspirée de FTMO - Le standard de l\'industrie',
        config: {
            accountType: '2steps',
            accountSize: 10000,
            riskSystem: 'static',
            profitTarget: 10,
            maxDrawdown: 10,
            consistency: 'none',
            profitSplit: 80,
            evalDays: 0,
            fundedDays: 0,
            leverage: 100,
            maxLotSize: 5
        },
        tags: ['populaire', 'standard', 'conservateur']
    },
    
    'five-star-traders': {
        name: 'Five Star Traders',
        emoji: '⭐',
        description: 'Configuration inspirée de The5ers - Pour les traders agressifs',
        config: {
            accountType: '2steps',
            accountSize: 20000,
            riskSystem: 'trailing',
            profitTarget: 8,
            maxDrawdown: 6,
            consistency: 'none',
            profitSplit: 100,
            evalDays: 0,
            fundedDays: 0,
            leverage: 200,
            maxLotSize: 8
        },
        tags: ['agressif', 'profit-max', 'flexibility']
    },
    
    'next-level-funding': {
        name: 'Next Level Funding',
        emoji: '🚀',
        description: 'Configuration inspirée de FundedNext - Rapide et flexible',
        config: {
            accountType: 'instant',
            accountSize: 15000,
            riskSystem: 'eod',
            profitTarget: 8,
            maxDrawdown: 5,
            consistency: '40',
            profitSplit: 90,
            evalDays: 0,
            fundedDays: 0,
            leverage: 100,
            maxLotSize: 6
        },
        tags: ['instant', 'rapide', 'flexible']
    },
    
    'forex-masters': {
        name: 'Forex Masters',
        emoji: '💎',
        description: 'Configuration inspirée de MyForexFunds - Pour les pros',
        config: {
            accountType: '2steps',
            accountSize: 50000,
            riskSystem: 'static',
            profitTarget: 8,
            maxDrawdown: 5,
            consistency: '30',
            profitSplit: 85,
            evalDays: 5,
            fundedDays: 3,
            leverage: 100,
            maxLotSize: 10
        },
        tags: ['pro', 'gros-compte', 'strict']
    },
    
    'fx-infinity': {
        name: 'FX Infinity',
        emoji: '♾️',
        description: 'Configuration inspirée de FXIFY - Liberté maximale',
        config: {
            accountType: '3steps',
            accountSize: 10000,
            riskSystem: 'trailing',
            profitTarget: 6,
            maxDrawdown: 8,
            consistency: 'none',
            profitSplit: 80,
            evalDays: 0,
            fundedDays: 0,
            leverage: 400,
            maxLotSize: 5
        },
        tags: ['débutant', 'progressif', 'liberal']
    },
    
    'elite-eight': {
        name: 'Elite Eight',
        emoji: '👑',
        description: 'Configuration inspirée de E8 Funding - Pour l\'élite',
        config: {
            accountType: '2steps',
            accountSize: 100000,
            riskSystem: 'static',
            profitTarget: 8,
            maxDrawdown: 4,
            consistency: '20',
            profitSplit: 80,
            evalDays: 10,
            fundedDays: 5,
            leverage: 50,
            maxLotSize: 10
        },
        tags: ['élite', 'strict', 'professionnel']
    },
    
    'true-traders': {
        name: 'True Traders',
        emoji: '✅',
        description: 'Configuration inspirée de True Forex Funds - Simplicité',
        config: {
            accountType: '2steps',
            accountSize: 25000,
            riskSystem: 'eod',
            profitTarget: 10,
            maxDrawdown: 6,
            consistency: 'none',
            profitSplit: 75,
            evalDays: 0,
            fundedDays: 0,
            leverage: 100,
            maxLotSize: 7
        },
        tags: ['simple', 'accessible', 'équilibré']
    },
    
    'peak-traders': {
        name: 'Peak Traders',
        emoji: '⛰️',
        description: 'Configuration inspirée d\'Apex - Sommet de performance',
        config: {
            accountType: '2steps',
            accountSize: 50000,
            riskSystem: 'trailing',
            profitTarget: 10,
            maxDrawdown: 5,
            consistency: '50',
            profitSplit: 90,
            evalDays: 7,
            fundedDays: 4,
            leverage: 100,
            maxLotSize: 8
        },
        tags: ['performance', 'équilibré', 'sérieux']
    },
    
    // ========================================
    // PRESETS PAR STYLE DE TRADING
    // ========================================
    
    'scalper-pro': {
        name: 'Scalper Pro',
        emoji: '⚡',
        description: 'Optimisé pour le scalping haute fréquence',
        config: {
            accountType: '2steps',
            accountSize: 10000,
            riskSystem: 'eod',
            profitTarget: 6,
            maxDrawdown: 4,
            consistency: 'none',
            profitSplit: 80,
            evalDays: 0,
            fundedDays: 0,
            leverage: 200,
            maxLotSize: 3
        },
        tags: ['scalping', 'rapide', 'technique']
    },
    
    'swing-master': {
        name: 'Swing Master',
        emoji: '📊',
        description: 'Parfait pour le swing trading (quelques jours)',
        config: {
            accountType: '2steps',
            accountSize: 25000,
            riskSystem: 'static',
            profitTarget: 8,
            maxDrawdown: 8,
            consistency: 'none',
            profitSplit: 85,
            evalDays: 0,
            fundedDays: 0,
            leverage: 50,
            maxLotSize: 5
        },
        tags: ['swing', 'patient', 'moyen-terme']
    },
    
    'day-trader': {
        name: 'Day Trader',
        emoji: '🌅',
        description: 'Configuration pour le day trading classique',
        config: {
            accountType: '2steps',
            accountSize: 15000,
            riskSystem: 'eod',
            profitTarget: 7,
            maxDrawdown: 5,
            consistency: '40',
            profitSplit: 80,
            evalDays: 5,
            fundedDays: 3,
            leverage: 100,
            maxLotSize: 5
        },
        tags: ['day-trading', 'discipliné', 'régulier']
    },
    
    'conservative': {
        name: 'Trader Conservateur',
        emoji: '🛡️',
        description: 'Risque minimal, progression stable',
        config: {
            accountType: '3steps',
            accountSize: 10000,
            riskSystem: 'static',
            profitTarget: 5,
            maxDrawdown: 3,
            consistency: '30',
            profitSplit: 70,
            evalDays: 10,
            fundedDays: 5,
            leverage: 30,
            maxLotSize: 2
        },
        tags: ['conservateur', 'sécurisé', 'stable']
    },
    
    'aggressive': {
        name: 'Trader Agressif',
        emoji: '🔥',
        description: 'Risque élevé, profit maximum',
        config: {
            accountType: 'instant',
            accountSize: 50000,
            riskSystem: 'trailing',
            profitTarget: 15,
            maxDrawdown: 12,
            consistency: 'none',
            profitSplit: 100,
            evalDays: 0,
            fundedDays: 0,
            leverage: 400,
            maxLotSize: 10
        },
        tags: ['agressif', 'risqué', 'profit-max']
    },
    
    // ========================================
    // PRESETS PAR BUDGET
    // ========================================
    
    'starter-pack': {
        name: 'Pack Débutant',
        emoji: '🌱',
        description: 'Petit budget, parfait pour commencer',
        config: {
            accountType: '3steps',
            accountSize: 2000,
            riskSystem: 'eod',
            profitTarget: 8,
            maxDrawdown: 6,
            consistency: 'none',
            profitSplit: 70,
            evalDays: 0,
            fundedDays: 0,
            leverage: 100,
            maxLotSize: 2
        },
        tags: ['débutant', 'petit-budget', 'apprentissage']
    },
    
    'intermediate': {
        name: 'Pack Intermédiaire',
        emoji: '📈',
        description: 'Budget moyen pour traders expérimentés',
        config: {
            accountType: '2steps',
            accountSize: 25000,
            riskSystem: 'static',
            profitTarget: 8,
            maxDrawdown: 5,
            consistency: '40',
            profitSplit: 80,
            evalDays: 5,
            fundedDays: 3,
            leverage: 100,
            maxLotSize: 6
        },
        tags: ['intermédiaire', 'expérimenté', 'équilibré']
    },
    
    'pro-package': {
        name: 'Pack Professionnel',
        emoji: '💼',
        description: 'Gros budget pour professionnels confirmés',
        config: {
            accountType: '2steps',
            accountSize: 100000,
            riskSystem: 'static',
            profitTarget: 10,
            maxDrawdown: 5,
            consistency: '30',
            profitSplit: 90,
            evalDays: 10,
            fundedDays: 5,
            leverage: 100,
            maxLotSize: 10
        },
        tags: ['pro', 'gros-budget', 'confirmé']
    }
};

// Fonction pour obtenir un preset par ID
function getPreset(presetId) {
    return PRESET_CONFIGS[presetId] || null;
}

// Fonction pour obtenir tous les presets
function getAllPresets() {
    return PRESET_CONFIGS;
}

// Fonction pour obtenir les presets par catégorie
function getPresetsByCategory(category) {
    const categories = {
        'propfirms': [
            'funds-trade-max',
            'five-star-traders',
            'next-level-funding',
            'forex-masters',
            'fx-infinity',
            'elite-eight',
            'true-traders',
            'peak-traders'
        ],
        'trading-style': [
            'scalper-pro',
            'swing-master',
            'day-trader',
            'conservative',
            'aggressive'
        ],
        'budget': [
            'starter-pack',
            'intermediate',
            'pro-package'
        ]
    };
    
    const presetIds = categories[category] || [];
    return presetIds.map(id => ({
        id,
        ...PRESET_CONFIGS[id]
    }));
}

// Exporter pour utilisation
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { PRESET_CONFIGS, getPreset, getAllPresets, getPresetsByCategory };
}
