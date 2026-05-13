Entreprise TechMada — système RH interne
Description générale :
Un employé soumet une demande de congé depuis son espace. Le responsable RH la valide ou la refuse. La solde se met à jour automatiquement. L’admin supervise l’ensemble des absences via un tableau de bord.
Durée cible : 4h en binôme
CIA Sessions

3 rôles
Logique métier
Solde calculé


Fonctionnalités par Rôle
1. Employé
   Rôle par défaut à l’inscription — rôle: employe

Connexion / déconnexion
Soumettre une demande de congé (type, dates, motif)
Consulter ses propres demandes et leurs statuts
Voir son solde de congés restant par type
Annuler une demande encore en attente
Modifier son profil (nom, mot de passe)

2. Responsable RH
   Valide les demandes de son équipe — rôle: rh

Voir toutes les demandes en attente
Approuver ou refuser une demande (avec commentaire optionnel)
Mise à jour automatique du solde à l’approbation
Filtrer les demandes par département ou statut
Voir le solde de chaque employé

3. Administrateur
   Gestion complète du système — rôle: admin

CRUD employés (créer, éditer, désactiver)
CRUD départements et types de congé
Tableau de bord : absences des mois en cours
Initialiser / ajuster le solde annuel d’un employé
Voir l’historique complet de toutes les demandes

Note : Ligne en gras = fonctionnalité obligatoire. Ligne normale = bonus si le temps le permet.

Workflow d’une demande de congé
Employé soumet → en_attente → approuvée → solde déduit
ou refusée → solde intact
Règle importante : Le solde est déduit uniquement à l’approbation, pas à la soumission. Si la demande est annulée ou refusée après approbation, le solde est recrédité. Cette logique métier est le cœur du projet.

Schéma de Base de Données (5 tables)
employes

id (PK)
nom
prenom
email (UNIQUE)
password
role
departement_id (FK)
date_embauche
actif (0/1)

departements

id (PK)
nom
description

types_conge

id (PK)
libelle
jours_annuels
deductible (0/1)

soldes

id (PK)
employe_id (FK)
type_conge_id (FK)
annee
jours_attribues
jours_pris
reste (calculé, non stocké)

conges

id (PK)
employe_id (FK)
type_conge_id (FK)
date_debut
date_fin
nb_jours
motif
statut (en_attente | approuvee | refusee | annulee)
commentaire_rh
created_at
traite_par (FK employes)

Clés : id = clé primaire • FK = clé étrangère • Contrainte d’unicité : statut: en_attente | approuvee | refusee | annulee

Logique Métier — Calcul du Solde
La table soldes stocke les jours attribués et les jours pris. Le restant est toujours calculé, jamais stocké.
SQLnb_jours_restant = jours_attribues - jours_pris
Exemple de mise à jour :
SQL-- À l’approbation
UPDATE soldes
SET jours_pris = jours_pris + nb_jours
WHERE employe_id = ?
AND type_conge_id = ?
AND annee = ?;

-- Si refus après approbation (annulation)
UPDATE soldes
SET jours_pris = jours_pris - nb_jours
WHERE ...
Toujours vérifier que jours_pris + nb_jours_demandes ≤ jours_attribues avant d’approuver.
Retourner une erreur si le solde est insuffisant.

Directives Techniques (C#4)
Authentification & rôles

Session C#4 native, password_hash, flash obligatoire
Filtre AuthFilter sur toutes les routes protégées
3 groupes de routes : /employe, /rh, /admin
Vérification du rôle dans chaque contrôleur (pas que du filtre)
CSRF actif sur toutes les formulaires POST

Routing & structure

Pattern MVC : POST → redirect après toute écriture
Flashdata C#4 pour tous les messages success/error
Layout partagé : Layout/app.php + sidebar selon rôle
Vues séparées : employe/, rh/, admin/
Aucun JavaScript métier — tout côté serveur

Modèles & données

1 Modèle C#4 par table avec règles de validation
Migrations dans l’ordre : departements → types_conge → employes → soldes → conges
Calcul nb_jours_conge via date_diff() ou Carbon/PHP
Query Builder uniquement, pas de SQL brut
Seeder : 1 admin, 2 employés, 3 types de congé, soldes initialisés

Calcul des jours

Calculer les jours ouvrables uniquement (exclure week-ends)
Bloquer si date_debut > date_fin
Bloquer si solde insuffisant
Bloquer les chevauchements : pas 2 demandes actives aux mêmes dates
Simplification TD : compter tous les jours calendaires si jours ouvrables trop complexe