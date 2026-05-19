# MLD — Modèle Logique de Données
## CandidatureTracker

> Traduction du MCD en tables relationnelles selon les conventions Laravel (snake_case, clés étrangères `<table_singulier>_id`).

---

## Tables

### `users`
| Colonne             | Type                 | Contraintes                      |
|---------------------|----------------------|----------------------------------|
| **id**              | BIGINT UNSIGNED      | PRIMARY KEY, AUTO_INCREMENT      |
| name                | VARCHAR(255)         | NOT NULL                         |
| email               | VARCHAR(255)         | NOT NULL, UNIQUE                 |
| email_verified_at   | TIMESTAMP            | NULL                             |
| password            | VARCHAR(255)         | NOT NULL                         |
| remember_token      | VARCHAR(100)         | NULL                             |
| created_at          | TIMESTAMP            | NULL                             |
| updated_at          | TIMESTAMP            | NULL                             |

---

### `candidatures`
| Colonne      | Type                   | Contraintes                                                                    |
|--------------|------------------------|--------------------------------------------------------------------------------|
| **id**       | BIGINT UNSIGNED        | PRIMARY KEY, AUTO_INCREMENT                                                    |
| user_id      | BIGINT UNSIGNED        | NOT NULL, FOREIGN KEY → `users(id)` ON DELETE CASCADE                         |
| company      | VARCHAR(255)           | NOT NULL                                                                       |
| role         | VARCHAR(255)           | NOT NULL                                                                       |
| offer_url    | VARCHAR(2048)          | NULL                                                                           |
| status       | ENUM(...)              | NOT NULL, DEFAULT `en_attente` — valeurs : `en_attente`, `en_cours`, `offre`, `refus`, `abandonne` |
| priority     | ENUM(...)              | NOT NULL, DEFAULT `normale` — valeurs : `faible`, `normale`, `haute`           |
| notes        | TEXT                   | NULL                                                                           |
| applied_at   | DATE                   | NOT NULL                                                                       |
| cv_path      | VARCHAR(2048)          | NULL (bonus — fichier joint)                                                   |
| deleted_at   | TIMESTAMP              | NULL (Soft Delete)                                                             |
| created_at   | TIMESTAMP              | NULL                                                                           |
| updated_at   | TIMESTAMP              | NULL                                                                           |

---

### `entretiens`
| Colonne         | Type            | Contraintes                                                                                       |
|-----------------|-----------------|---------------------------------------------------------------------------------------------------|
| **id**          | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT                                                                       |
| candidature_id  | BIGINT UNSIGNED | NOT NULL, FOREIGN KEY → `candidatures(id)` ON DELETE CASCADE                                     |
| type            | ENUM(...)       | NOT NULL — valeurs : `telephonique`, `visio`, `presentiel`, `technique`, `rh`                    |
| scheduled_at    | DATETIME        | NOT NULL                                                                                          |
| notes           | TEXT            | NULL                                                                                              |
| result          | ENUM(...)       | NULL, DEFAULT NULL — valeurs : `en_attente`, `positif`, `negatif`                                |
| created_at      | TIMESTAMP       | NULL                                                                                              |
| updated_at      | TIMESTAMP       | NULL                                                                                              |

---

## Schéma relationnel

```
users
  └─ id (PK)
  └─ name
  └─ email (UNIQUE)
  └─ password
  └─ ...

candidatures
  └─ id (PK)
  └─ user_id (FK → users.id)     ← clé étrangère
  └─ company
  └─ role
  └─ offer_url
  └─ status
  └─ priority
  └─ notes
  └─ applied_at
  └─ cv_path
  └─ deleted_at                   ← Soft Delete
  └─ ...

entretiens
  └─ id (PK)
  └─ candidature_id (FK → candidatures.id)    ← clé étrangère
  └─ type
  └─ scheduled_at
  └─ notes
  └─ result
  └─ ...
```

---

## Relations Eloquent (Laravel)

| Modèle          | Relation          | Méthode                                         |
|-----------------|-------------------|-------------------------------------------------|
| `User`          | hasMany           | `candidatures(): HasMany`                       |
| `Candidature`   | belongsTo         | `user(): BelongsTo`                             |
| `Candidature`   | hasMany           | `entretiens(): HasMany`                         |
| `Entretien`     | belongsTo         | `candidature(): BelongsTo`                      |

---

## Règles d'intégrité

| Règle                                   | Implémentation                                              |
|-----------------------------------------|-------------------------------------------------------------|
| Un utilisateur ne voit que ses données  | Policy — vérification `$user->id === $candidature->user_id` |
| Suppression d'une candidature           | Soft Delete (`deleted_at`) — restauration possible          |
| Suppression définitive d'une candidature| Cascade → supprime les entretiens liés + fichier joint      |
| Zéro N+1                                | Eager loading : `Candidature::with('entretiens')`           |

---

## Règles de nommage Laravel respectées

- Tables au **pluriel snake_case** : `users`, `candidatures`, `entretiens`
- Clés étrangères : `<singulier>_id` → `user_id`, `candidature_id`
- Timestamps automatiques : `created_at`, `updated_at` (gérés par Eloquent)
- Soft delete : `deleted_at` (via trait `SoftDeletes`)
