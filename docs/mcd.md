# MCD — Modèle Conceptuel de Données
## CandidatureTracker

---

## Entités et attributs

### USER
| Attribut          | Type      | Remarque              |
|-------------------|-----------|-----------------------|
| **id**            | Entier    | Identifiant           |
| name              | Chaîne    |                       |
| email             | Chaîne    | Unique                |
| password          | Chaîne    | Haché (bcrypt)        |
| email_verified_at | DateTime  | Nullable              |
| remember_token    | Chaîne    | Nullable              |
| created_at        | DateTime  |                       |
| updated_at        | DateTime  |                       |

---

### CANDIDATURE
| Attribut       | Type      | Remarque                                                    |
|----------------|-----------|-------------------------------------------------------------|
| **id**         | Entier    | Identifiant                                                 |
| company        | Chaîne    | Nom de l'entreprise                                         |
| role           | Chaîne    | Poste visé                                                  |
| offer_url      | Chaîne    | URL de l'offre — nullable                                   |
| status         | Enum      | `en_attente`, `en_cours`, `offre`, `refus`, `abandonne`     |
| priority       | Enum      | `faible`, `normale`, `haute`                                |
| notes          | Texte     | Nullable                                                    |
| applied_at     | Date      | Date de candidature                                         |
| cv_path        | Chaîne    | Chemin fichier CV/LM — nullable (bonus)                     |
| deleted_at     | DateTime  | Soft delete — nullable                                      |
| created_at     | DateTime  |                                                             |
| updated_at     | DateTime  |                                                             |

---

### ENTRETIEN
| Attribut       | Type      | Remarque                                                                        |
|----------------|-----------|---------------------------------------------------------------------------------|
| **id**         | Entier    | Identifiant                                                                     |
| type           | Enum      | `telephonique`, `visio`, `presentiel`, `technique`, `rh`                        |
| scheduled_at   | DateTime  | Date et heure planifiées                                                        |
| notes          | Texte     | Notes de préparation — nullable                                                 |
| result         | Enum      | `en_attente`, `positif`, `negatif` — nullable                                   |
| created_at     | DateTime  |                                                                                 |
| updated_at     | DateTime  |                                                                                 |

---

## Associations et cardinalités (notation Merise)

```
┌─────────────────────┐           ┌──────────────────────────┐           ┌────────────────────┐
│        USER         │           │       CANDIDATURE         │           │      ENTRETIEN      │
├─────────────────────┤           ├──────────────────────────┤           ├────────────────────┤
│ # id                │           │ # id                     │           │ # id               │
│   name              │           │   company                │           │   type             │
│   email             │           │   role                   │           │   scheduled_at     │
│   password          │           │   offer_url              │           │   notes            │
│   email_verified_at │           │   status                 │           │   result           │
│   remember_token    │           │   priority               │           │   created_at       │
│   created_at        │           │   notes                  │           │   updated_at       │
│   updated_at        │           │   applied_at             │           └────────────────────┘
└─────────────────────┘           │   cv_path                │
           │                      │   deleted_at             │                      │
           │                      │   created_at             │                      │
         (1,1)                    │   updated_at             │                    (1,1)
           │                      └──────────────────────────┘                      │
           │                                 │                                      │
        soumet                             (1,N)                               appartient
           │                                                                         │
         (1,N)                                                                     (0,N)
                                                                                     │
                                                                                  comporte
```

### Lecture des cardinalités

| Association    | Lecture                                                                               |
|----------------|---------------------------------------------------------------------------------------|
| **soumet**     | Un utilisateur soumet **1 à N** candidatures. Une candidature appartient à **1 seul** utilisateur. |
| **comporte**   | Une candidature comporte **0 à N** entretiens. Un entretien appartient à **1 seule** candidature.  |

---

## Diagramme simplifié

```
USER (1,1) ────── soumet ────── (1,N) CANDIDATURE (1,1) ────── comporte ────── (0,N) ENTRETIEN
```

---

## Valeurs des énumérations

### Statuts (`candidatures.status`)
| Valeur         | Libellé (FR)     |
|----------------|------------------|
| `en_attente`   | En attente       |
| `en_cours`     | En cours         |
| `offre`        | Offre reçue      |
| `refus`        | Refus            |
| `abandonne`    | Abandonné        |

### Priorités (`candidatures.priority`)
| Valeur     | Libellé (FR) |
|------------|--------------|
| `faible`   | Faible       |
| `normale`  | Normale      |
| `haute`    | Haute        |

### Types d'entretien (`entretiens.type`)
| Valeur          | Libellé (FR)       |
|-----------------|--------------------|
| `telephonique`  | Téléphonique       |
| `visio`         | Visioconférence    |
| `presentiel`    | Présentiel         |
| `technique`     | Technique          |
| `rh`            | RH                 |

### Résultats d'entretien (`entretiens.result`)
| Valeur        | Libellé (FR) |
|---------------|--------------|
| `en_attente`  | En attente   |
| `positif`     | Positif      |
| `negatif`     | Négatif      |
