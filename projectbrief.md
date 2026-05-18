# CandidatureTracker — Project Brief

## Overview

**CandidatureTracker** is a personal Laravel application for tracking job applications. It centralizes the entire job search process: logging applications by company, attaching interview stages to each record, tracking the status of every opportunity, and archiving completed records without losing history.

| | |
|---|---|
| **Référentiel** | [2023] Développeur web et web mobile — DWWM/Backend |
| **Mode** | Individuel |
| **Durée** | 5 jours |
| **Lancement** | Lundi 18/05/2026 — 10:00 |
| **Deadline** | Vendredi 22/05/2026 — 16:30 |

---

## Context & Problem

Job searching as a recent graduate is a major organizational challenge. Juggling startups, agencies, and large companies leads quickly to information overload.

Managing applications informally via simple notes has clear limits: missed follow-ups, overlapping interviews, and no visibility over the recruitment funnel.

**Goal:** Centralize these flows to transform stressful mental load into a structured, efficient process.

---

## Application Objective

Develop **CandidatureTracker**, a dedicated Laravel solution for personalized tracking. The tool will:

- Register each opportunity
- Plan interview stages
- Maintain a complete history of all interactions
- Ensure optimal responsiveness to recruiters

---

## User Stories

| ID | Story |
|----|-------|
| **US1** | **Auth** — Register, log in, and log out. |
| **US2** | **Application List** — View all active applications with key info at a glance. |
| **US3** | **Create Application** — Log a new application: company name, target role, offer URL (optional), status, priority, free notes, application date. |
| **US4** | **Application Detail** — View full details of an application and all associated interviews. |
| **US5** | **Edit Application** — Modify the information of any application. |
| **US6** | **Archive Application** — Archive a completed application to remove it from the main list without permanent deletion. |
| **US7** | **Archives Page** — View archived applications on a dedicated page. |
| **US8** | **Restore Application** — Restore an archived application back to the active list. |
| **US9** | **Filters** — Filter the application list by status and/or priority. |
| **US10** | **Add Interview** — Add an interview to an application: type, planned date & time, preparation notes (optional), result. |
| **US11** | **Edit / Delete Interview** — Edit interview info or delete an interview. |

### Bonus Features

- **File Storage** — Attach a file to an application (CV, cover letter, etc.). Stored via `Storage::disk`, downloadable from the detail page, deleted from disk when the application is deleted.
- **Unit & Feature Tests** — Write Pest tests covering critical scenarios: unauthorized access blocked by Policy, application creation with valid and invalid data, archiving and restoration. All tests pass with `php artisan test`.

---

## Technical Constraints & Quality Requirements

| Constraint | Requirement |
|---|---|
| Authentication | Laravel Breeze |
| Routes | All routes named |
| Protection | All routes protected by `auth` middleware |
| Validation | Form Request classes — no `$request->validate()` in controllers |
| Mass Assignment | `$fillable` defined on every model |
| Authorization | Policy — a user cannot modify or delete another user's resources |
| Archiving | Soft Deletes on applications |
| Localization | Statuses and priorities displayed in French in views |
| Performance | Zero N+1 queries, verifiable live with Debugbar |
| Security | `@csrf` on all forms |
| Lists | `@forelse` for all lists with empty state handled |

---

## Deliverables

### 1. GitHub Repository
- Minimum **15 commits** with explicit messages
- `README.md` with complete installation instructions

### 2. Jira Board
- Shared before Monday 16:00
- All User Stories as tickets with visible movement history

### 3. MCD & MLD
- Submitted Monday before 16:00

### 4. Presentation Slides

---

## Evaluation — Individual Interview (45 min)

| Phase | Duration | Description |
|---|---|---|
| Presentation + Demo | 10 min | Live demo of the application |
| Code Review & Q&A | 20 min | Concepts, implementation choices |
| Situational Exercise | 15 min | Problem presented by the jury |

---

## Performance Criteria

### 1. Cahier des Charges Compliance — 20%
- All User Stories delivered and functional
- Technical constraints respected (named routes, Form Requests, `$fillable`, `@csrf`, `@forelse`, Soft Deletes, Policy, zero N+1)
- MCD and MLD correct and validated

### 2. Mastery of Implemented Laravel Concepts — 30%
- Genuine understanding (not blind copying) of: Routing, Controllers, Eloquent ORM (relations, accessors, soft deletes), Policies, Middleware, Blade, Form Requests
- Ability to explain each implementation choice

### 3. Presentation & Demo Quality — 15%
- Smooth, complete live demo with no blocking bugs
- Clear slides with MCD/MLD explained
- Structured narrative: context → architecture → technical decisions → difficulties encountered

### 4. Oral Defense — Q&A — 20%
- Ability to define Laravel and PHP OOP concepts used in the project
- Structured answers: nature → purpose → example from the code
- Explanations that demonstrate understanding, not recitation

### 5. Situational Exercise — 15%
- Quick grasp of the problem posed by the jury
- Proposal of a methodical approach before writing code
- Execution (even partial) with correct logic — *the approach matters as much as the final result*
