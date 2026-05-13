# DESIGN.md — Interface Responsable RH · TechMada

> **Document de référence visuelle et fonctionnelle**
> À lire intégralement avant de toucher une seule ligne de code HTML/CSS.

---

## 1. Philosophie de Design

### Identité visuelle choisie : **"Corporate Precision"**
Registre **utilitaire-raffiné** : sobre, dense en information, mais jamais froid.
L'interface doit inspirer **confiance et contrôle** — le RH est un décideur, chaque élément visuel doit renforcer ce sentiment d'autorité et de clarté.

**Le mot clé : Lisibilité d'abord, esthétique en soutien.**

---

## 2. Palette de Couleurs

Définir ces variables CSS dans un fichier `variables.css` ou dans `:root` de `app.css` :

```css
:root {
  /* Couleurs primaires */
  --color-bg:          #F4F5F7;   /* Fond général : gris très clair, neutre */
  --color-surface:     #FFFFFF;   /* Cartes, panneaux, tableaux */
  --color-sidebar:     #1A2238;   /* Sidebar foncée : bleu marine profond */
  --color-sidebar-txt: #CBD5E1;   /* Texte secondaire sidebar */
  --color-accent:      #2563EB;   /* Bleu action (boutons, liens, focus) */
  --color-accent-hover:#1D4ED8;   /* Bleu plus sombre au survol */

  /* Couleurs sémantiques — OBLIGATOIRES pour les statuts */
  --color-pending:     #F59E0B;   /* Jaune ambre : en_attente */
  --color-approved:    #10B981;   /* Vert émeraude : approuvée */
  --color-refused:     #EF4444;   /* Rouge vif : refusée */
  --color-cancelled:   #94A3B8;   /* Gris ardoise : annulée */

  /* Textes */
  --color-text-primary:   #111827;
  --color-text-secondary: #6B7280;
  --color-text-muted:     #9CA3AF;

  /* Bordures & ombres */
  --color-border:      #E5E7EB;
  --shadow-card:       0 1px 3px rgba(0,0,0,0.08), 0 1px 2px rgba(0,0,0,0.05);
  --shadow-modal:      0 20px 60px rgba(0,0,0,0.15);
}
```

**Règle d'or** : Ne jamais utiliser de couleur en dur dans les vues.
Toujours référencer une variable CSS. Cela garantit la cohérence globale.

---

## 3. Typographie

```css
/* Importer dans <head> ou @import en CSS */
@import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=DM+Mono:wght@400;500&display=swap');

:root {
  --font-body:  'DM Sans', sans-serif;   /* Texte courant, labels, paragraphes */
  --font-mono:  'DM Mono', monospace;    /* Nombres, dates, codes de référence */
}
```

### Hiérarchie typographique

| Élément | Taille | Poids | Variable |
|---|---|---|---|
| Titre de page (h1) | 22px | 600 | `--font-body` |
| Titre de section (h2) | 16px | 600 | `--font-body` |
| Label de tableau (th) | 11px | 600 | `--font-body`, UPPERCASE, letter-spacing: 0.06em |
| Texte courant (td, p) | 14px | 400 | `--font-body` |
| Valeurs numériques | 14px | 500 | `--font-mono` |
| Badge de statut | 11px | 600 | `--font-body`, UPPERCASE |
| Bouton principal | 14px | 500 | `--font-body` |

---

## 4. Structure de Page — Layout Global

```
┌─────────────────────────────────────────────────────┐
│  SIDEBAR (240px fixe)  │  ZONE PRINCIPALE (flex 1)   │
│  fond: --color-sidebar │  fond: --color-bg            │
│                        │                              │
│  [Logo TechMada]       │  [TOPBAR — 56px fixe]        │
│                        │  ┌──────────────────────┐    │
│  ── Navigation ──      │  │ Titre + fil d'Ariane  │    │
│  > Tableau de bord     │  └──────────────────────┘    │
│  > Demandes en attente │                              │
│  > Tous les congés     │  [CONTENU SCROLLABLE]        │
│  > Soldes équipe       │                              │
│                        │                              │
│  ── [Avatar + Nom] ──  │                              │
│  > Déconnexion         │                              │
└─────────────────────────────────────────────────────┘
```

### Règles de layout
- La sidebar est **fixe** (`position: fixed; height: 100vh`), le contenu défile indépendamment.
- Le contenu principal a un `padding: 32px` sur desktop.
- Largeur maximale du contenu : `max-width: 1100px; margin: 0 auto`.
- Pas de scroll horizontal : tout doit être responsive à partir de 768px.

---

## 5. Composants UI — Spécifications Détaillées

### 5.1 — Sidebar

```
Fond : --color-sidebar (#1A2238)
Largeur : 240px

[Logo]
  font-size: 18px | font-weight: 700 | color: white
  padding: 24px 20px | border-bottom: 1px solid rgba(255,255,255,0.08)

[Lien de navigation]
  padding: 10px 16px | border-radius: 8px | margin: 2px 8px
  color: --color-sidebar-txt
  transition: background 150ms ease

  État ACTIF :
    background: rgba(37, 99, 235, 0.25)  ← bleu semi-transparent
    color: white
    border-left: 3px solid --color-accent

  État survol :
    background: rgba(255, 255, 255, 0.06)
    color: white

[Section utilisateur] — épinglée en bas
  border-top: 1px solid rgba(255,255,255,0.08)
  padding: 16px 20px
  display: flex | align-items: center | gap: 12px

  [Avatar initiales]
    width: 36px | height: 36px | border-radius: 50%
    background: --color-accent | color: white
    font-size: 13px | font-weight: 600
```

---

### 5.2 — Topbar

```
Hauteur : 56px | Fond : --color-surface | border-bottom: 1px solid --color-border
padding: 0 32px | display: flex | align-items: center | justify-content: space-between

[Gauche]
  h1 — titre de la page courante (ex: "Demandes en attente")
  font-size: 20px | font-weight: 600 | color: --color-text-primary

[Droite]
  Nom du RH connecté | font-size: 14px | color: --color-text-secondary
```

---

### 5.3 — Cartes de statistiques (KPI Cards)

Affichées en ligne horizontale en haut du tableau de bord RH.

```
Layout : grid | grid-template-columns: repeat(4, 1fr) | gap: 16px

[Chaque carte]
  background: --color-surface
  border: 1px solid --color-border
  border-radius: 10px
  padding: 20px 24px
  box-shadow: --shadow-card

  [Valeur principale]
    font-size: 32px | font-weight: 600 | font-family: --font-mono
    color: --color-text-primary

  [Label]
    font-size: 12px | font-weight: 500 | color: --color-text-secondary
    text-transform: uppercase | letter-spacing: 0.06em | margin-top: 4px

  [Accent coloré selon contexte]
    border-top: 3px solid [couleur sémantique]
    Ex: en_attente → --color-pending
```

**4 KPI à afficher pour le RH :**
1. Demandes en attente (accent jaune)
2. Approuvées ce mois (accent vert)
3. Refusées ce mois (accent rouge)
4. Employés dans l'équipe (accent bleu)

---

### 5.4 — Tableau des demandes

C'est l'élément central de l'interface RH. Il doit être **dense, lisible, et actionnable**.

```
[Conteneur]
  background: --color-surface
  border: 1px solid --color-border
  border-radius: 10px
  overflow: hidden  ← pour que les coins du tableau soient arrondis

[En-tête du tableau (thead)]
  background: #F9FAFB  ← légèrement différent du fond carte
  border-bottom: 2px solid --color-border

  th :
    padding: 10px 16px
    font-size: 11px | font-weight: 600
    text-transform: uppercase | letter-spacing: 0.06em
    color: --color-text-secondary

[Ligne de données (tr)]
  border-bottom: 1px solid --color-border
  transition: background 100ms

  tr:hover :
    background: #F8FAFC

  td :
    padding: 14px 16px
    font-size: 14px | color: --color-text-primary
    vertical-align: middle
```

#### Colonnes obligatoires du tableau RH

| # | Colonne | Contenu | Style |
|---|---|---|---|
| 1 | Employé | Prénom Nom + département en sous-texte | `--font-body`, nom en 500, dépt en `--color-text-muted` 12px |
| 2 | Type | Label du type de congé | Badge gris neutre |
| 3 | Dates | du JJ/MM/AAAA au JJ/MM/AAAA | `--font-mono` 13px |
| 4 | Durée | X jours | `--font-mono`, centré |
| 5 | Statut | Badge coloré | Voir §5.5 |
| 6 | Soumis le | Date de création | `--color-text-muted` |
| 7 | Actions | Boutons Approuver / Refuser | Voir §5.6 |

---

### 5.5 — Badges de Statut

Les badges sont des marqueurs visuels critiques. Ils doivent être immédiatement reconnaissables.

```css
.badge {
  display: inline-flex;
  align-items: center;
  padding: 3px 10px;
  border-radius: 20px;        /* Pill shape */
  font-size: 11px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  gap: 5px;                   /* Espace entre point et texte */
}

/* Point coloré avant le texte */
.badge::before {
  content: '';
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: currentColor;
}

.badge--pending   { background: #FEF3C7; color: #92400E; }  /* Jaune doux */
.badge--approved  { background: #D1FAE5; color: #065F46; }  /* Vert doux  */
.badge--refused   { background: #FEE2E2; color: #991B1B; }  /* Rouge doux */
.badge--cancelled { background: #F1F5F9; color: #475569; }  /* Gris doux  */
```

**Règle** : Jamais de fond opaque saturé pour un badge — toujours la version pastel (10-15% d'opacité).

---

### 5.6 — Boutons d'Action

#### Bouton principal (Approuver)
```css
.btn-approve {
  background: var(--color-approved);  /* Vert */
  color: white;
  border: none;
  padding: 6px 14px;
  border-radius: 6px;
  font-size: 13px;
  font-weight: 500;
  cursor: pointer;
  transition: opacity 150ms, transform 100ms;
}
.btn-approve:hover {
  opacity: 0.88;
  transform: translateY(-1px);
}
```

#### Bouton secondaire (Refuser)
```css
.btn-refuse {
  background: transparent;
  color: var(--color-refused);
  border: 1.5px solid var(--color-refused);
  padding: 5px 14px;
  border-radius: 6px;
  font-size: 13px;
  font-weight: 500;
  cursor: pointer;
  transition: background 150ms, color 150ms;
}
.btn-refuse:hover {
  background: var(--color-refused);
  color: white;
}
```

**Règle UX** : Les deux boutons doivent être **toujours côte à côte**, dans cet ordre : Approuver d'abord (action positive), Refuser ensuite. L'espacement entre eux : `gap: 8px`.

---

### 5.7 — Barre de Filtres

Placée au-dessus du tableau, dans le même conteneur.

```
[Conteneur filtres]
  padding: 16px 20px
  border-bottom: 1px solid --color-border
  display: flex | align-items: center | gap: 12px | flex-wrap: wrap

[Select — Filtrer par département]
  height: 36px | padding: 0 12px
  border: 1.5px solid --color-border | border-radius: 6px
  font-size: 13px | background: white | color: --color-text-primary
  min-width: 180px

[Select — Filtrer par statut]
  Même style que ci-dessus | min-width: 150px

[Bouton Reset]
  background: transparent | color: --color-text-secondary
  font-size: 13px | border: none | cursor: pointer
  text-decoration: underline
  margin-left: auto  ← pousse à droite
```

---

### 5.8 — Modale de Refus (avec commentaire RH)

Quand le RH clique "Refuser", une modale s'ouvre pour saisir un commentaire.

```
[Overlay]
  position: fixed | inset: 0
  background: rgba(0, 0, 0, 0.45)
  backdrop-filter: blur(2px)
  z-index: 100

[Boîte modale]
  background: white
  border-radius: 12px
  padding: 32px
  width: 480px | max-width: 90vw
  box-shadow: --shadow-modal
  position: fixed | top: 50% | left: 50%
  transform: translate(-50%, -50%)

[Titre]
  font-size: 18px | font-weight: 600 | color: --color-refused
  margin-bottom: 8px

[Sous-titre]
  Rappel : Nom de l'employé + dates de la demande
  font-size: 14px | color: --color-text-secondary | margin-bottom: 20px

[Textarea commentaire]
  width: 100% | min-height: 100px
  border: 1.5px solid --color-border | border-radius: 8px
  padding: 12px | font-size: 14px | resize: vertical
  font-family: --font-body

  :focus → border-color: --color-accent | outline: none
           box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12)

[Boutons]
  display: flex | justify-content: flex-end | gap: 10px | margin-top: 20px
  [Annuler] → btn secondaire neutre
  [Confirmer le refus] → btn-refuse (rouge plein)
```

---

### 5.9 — Barre de Soldes par Employé

Une section dédiée dans le panneau RH, affichant les soldes de l'équipe.

```
[Carte solde]
  Même style carte que §5.3 mais full-width

[Ligne par employé]
  display: grid | grid-template-columns: 2fr 1fr 1fr 1fr | align-items: center
  padding: 12px 0 | border-bottom: 1px solid --color-border

  [Nom] → font-weight: 500
  [Type congé] → badge gris neutre | font-size: 12px
  [Jours attribués] → --font-mono | text-align: center
  [Jours restants] → --font-mono | text-align: center
    Couleur selon niveau :
      > 50% restant → --color-approved (vert)
      20-50% restant → --color-pending (jaune)
      < 20% restant → --color-refused (rouge)

[Barre de progression]
  height: 4px | border-radius: 2px | background: --color-border | margin-top: 6px
  [Fill] → background selon niveau | transition: width 400ms ease
```

---

## 6. Messages Flash (Feedback utilisateur)

Affichés en haut du contenu principal, sous la topbar, avant de disparaître.

```
[Conteneur flash]
  margin-bottom: 20px

.flash-success {
  background: #D1FAE5;
  border-left: 4px solid var(--color-approved);
  color: #065F46;
  padding: 12px 16px;
  border-radius: 6px;
  font-size: 14px;
}

.flash-error {
  background: #FEE2E2;
  border-left: 4px solid var(--color-refused);
  color: #991B1B;
  padding: 12px 16px;
  border-radius: 6px;
  font-size: 14px;
}
```

**Règle** : Les flash messages CodeIgniter 4 sont rendus dans `Layout/app.php`, dans la zone de contenu, via `session()->getFlashdata('success')` et `session()->getFlashdata('error')`.

---

## 7. États Vides (Empty States)

Quand le tableau n'a aucune donnée à afficher.

```
[Conteneur centré]
  padding: 60px 20px | text-align: center

[Icône] (SVG ou emoji)
  font-size: 40px | margin-bottom: 16px | opacity: 0.3

[Texte principal]
  font-size: 16px | font-weight: 500 | color: --color-text-secondary

[Sous-texte]
  font-size: 14px | color: --color-text-muted | margin-top: 6px
```

Exemple de message : "Aucune demande en attente" / "Toutes les demandes ont été traitées ✓"

---

## 8. Règles CSS Globales (à mettre dans app.css)

```css
*, *::before, *::after {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: var(--font-body);
  background: var(--color-bg);
  color: var(--color-text-primary);
  font-size: 14px;
  line-height: 1.5;
  -webkit-font-smoothing: antialiased;
}

a {
  color: var(--color-accent);
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}

table {
  width: 100%;
  border-collapse: collapse;
}

select, input, textarea {
  font-family: var(--font-body);
}
```

---

## 9. Responsive (Breakpoint unique : 768px)

En dessous de 768px de largeur :

- La sidebar se replie en menu hamburger (icône ☰ dans la topbar)
- Les KPI cards passent de `repeat(4, 1fr)` à `repeat(2, 1fr)`
- Le tableau devient scrollable horizontalement (`overflow-x: auto` sur le wrapper)
- Les boutons d'action se réduisent à des icônes avec tooltip

```css
@media (max-width: 768px) {
  .sidebar         { transform: translateX(-240px); transition: transform 250ms; }
  .sidebar.open    { transform: translateX(0); }
  .kpi-grid        { grid-template-columns: repeat(2, 1fr); }
  .table-wrapper   { overflow-x: auto; }
}
```

---

## 10. Checklist de Conformité Visuelle

Avant de soumettre ton travail, vérifier chaque point :

- [ ] Toutes les couleurs utilisent des variables CSS (zéro couleur en dur)
- [ ] Les 4 statuts ont chacun leur badge distinctif et cohérent
- [ ] Le bouton "Approuver" est toujours **à gauche** du bouton "Refuser"
- [ ] Les flash messages sont visibles et positionnés correctement
- [ ] L'état vide du tableau est géré et affiché proprement
- [ ] La sidebar indique clairement la page active (état actif visible)
- [ ] Les valeurs numériques (jours, dates) utilisent `--font-mono`
- [ ] Le tableau a bien un en-tête figé si scroll vertical
- [ ] La modale de refus est accessible (focus trap, fermeture au clic overlay)
- [ ] La page est lisible sur mobile (768px minimum)

---

*Document produit pour le projet TechMada — Système RH interne · Rôle : Responsable RH*
