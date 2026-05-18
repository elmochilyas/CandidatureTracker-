# CandidatureTracker — Task List

> Each task has a **Jira-ready title**, a **description**, the **concepts to know**, and **acceptance criteria**.
> Suggested labels: `setup`, `auth`, `candidature`, `interview`, `ui`, `bonus`, `deliverable`

---

## 🗂️ EPIC 1 — Project Setup & Architecture

---

### TASK-01 — Initialize Laravel project with Breeze and core dependencies

**Label:** `setup`
**Priority:** Highest
**Estimate:** 1h

**Description:**
Scaffold the Laravel application, install Laravel Breeze for authentication, and set up all foundational dependencies needed for the project (Debugbar, Pest, etc.).

**Concepts to know:**
- `composer create-project` and Laravel directory structure
- Laravel Breeze installation and what it scaffolds (routes, views, controllers)
- `.env` configuration: APP_NAME, DB connection
- `php artisan migrate` — running default Breeze migrations
- Difference between `npm run dev` and `npm run build`

**Acceptance Criteria:**
- [ ] Laravel project created and running locally (`php artisan serve`)
- [ ] Laravel Breeze installed and `php artisan migrate` runs without errors
- [ ] Register, login, logout pages are accessible at `/register`, `/login`
- [ ] `laravel-debugbar` installed and visible in dev environment
- [ ] Pest installed and `php artisan test` runs with 0 errors on the default suite
- [ ] `.env.example` updated with all required keys

---

### TASK-02 — Design and document MCD & MLD

**Label:** `setup`, `deliverable`
**Priority:** Highest
**Estimate:** 1h30
**Due:** Monday 18/05 before 16:00

**Description:**
Design the conceptual data model (MCD) and the logical data model (MLD) for the application before writing any migrations. This shapes every model and relation in the codebase.

**Concepts to know:**
- Entities, attributes, and cardinalities in a MCD
- Translating a MCD to a MLD (primary keys, foreign keys, join tables)
- Laravel naming conventions for tables and foreign keys (`candidatures`, `entretiens`, `user_id`)
- One-to-Many relationship: User → Candidatures, Candidature → Entretiens

**Acceptance Criteria:**
- [ ] MCD includes: `User`, `Candidature`, `Entretien` entities with all attributes
- [ ] MLD correctly maps all foreign key relationships
- [ ] `candidatures` table includes: `user_id`, `company`, `role`, `offer_url`, `status`, `priority`, `notes`, `applied_at`, `deleted_at` (soft delete)
- [ ] `entretiens` table includes: `candidature_id`, `type`, `scheduled_at`, `notes`, `result`
- [ ] Document exported/shared before Monday 16:00

---

### TASK-03 — Create migrations and Eloquent models

**Label:** `setup`
**Priority:** Highest
**Estimate:** 1h

**Description:**
Write all database migrations and define the corresponding Eloquent models with their relationships, `$fillable` arrays, and soft delete support.

**Concepts to know:**
- `php artisan make:migration` and migration structure (`up()` / `down()`)
- Column types: `string`, `text`, `enum`, `timestamp`, `foreignId()->constrained()`
- `SoftDeletes` trait on the model and `$table->softDeletes()` in migration
- `$fillable` vs `$guarded` — why `$fillable` is the required choice here
- Defining Eloquent relations: `belongsTo`, `hasMany`
- Accessors (optional): formatting status/priority display labels

**Acceptance Criteria:**
- [ ] Migration for `candidatures` runs without errors
- [ ] Migration for `entretiens` runs without errors
- [ ] `Candidature` model has: `SoftDeletes`, `$fillable`, `belongsTo(User)`, `hasMany(Entretien)`
- [ ] `Entretien` model has: `$fillable`, `belongsTo(Candidature)`
- [ ] `User` model has: `hasMany(Candidature)`
- [ ] `php artisan migrate:fresh` runs cleanly

---

## 🔐 EPIC 2 — Authentication (US1)

---

### TASK-04 — Configure and validate authentication flow

**Label:** `auth`
**Priority:** High
**Estimate:** 30min

**Description:**
Verify and finalize the Breeze authentication scaffolding. Ensure all auth routes are named, protected where needed, and the post-login redirect goes to the application dashboard.

**Concepts to know:**
- What Laravel Breeze generates: `RegisteredUserController`, `AuthenticatedSessionController`
- Named routes: `route('login')`, `route('register')`, `route('dashboard')`
- `auth` middleware and how to apply it to route groups
- `RouteServiceProvider::HOME` — changing the post-auth redirect

**Acceptance Criteria:**
- [ ] User can register with name, email, password — stored with hashed password
- [ ] User can log in and is redirected to the candidatures index
- [ ] User can log out and is redirected to `/login`
- [ ] Unauthenticated users accessing protected routes are redirected to `/login`
- [ ] All auth routes are named (`login`, `register`, `logout`, etc.)

---

## 📋 EPIC 3 — Candidature Management (US2–US9)

---

### TASK-05 — List active candidatures (US2)

**Label:** `candidature`
**Priority:** High
**Estimate:** 1h

**Description:**
Build the main dashboard view listing all non-archived candidatures belonging to the authenticated user, with essential info visible at a glance.

**Concepts to know:**
- Eloquent scoping: filtering by `user_id` via relationship or `where('user_id', auth()->id())`
- Why NOT to query `Candidature::all()` — security and correctness
- `@forelse` / `@empty` Blade directives
- Eager loading with `->with('entretiens')` to prevent N+1
- Passing data from controller to view with `compact()` or `->with()`

**Acceptance Criteria:**
- [ ] Page only shows candidatures belonging to the authenticated user
- [ ] Each row displays: company, role, status, priority, application date
- [ ] Archived candidatures (soft-deleted) do NOT appear
- [ ] Empty state message displayed when no candidatures exist (`@forelse`)
- [ ] Zero N+1 queries verified in Debugbar
- [ ] Route is named (`candidatures.index`) and protected by `auth`

---

### TASK-06 — Create a candidature (US3)

**Label:** `candidature`
**Priority:** High
**Estimate:** 1h30

**Description:**
Build the form and backend logic to create a new candidature. Validation must be handled via a dedicated Form Request class.

**Concepts to know:**
- `php artisan make:request StoreCandidatureRequest`
- Form Request: `authorize()` method, `rules()` method
- Validation rules: `required`, `nullable`, `url`, `date`, `in:` for enums
- `@csrf` directive — what it does and why it's required
- Associating the new record to the authenticated user: `auth()->id()`
- Flash messages with `session()->flash()` and displaying them in Blade
- Redirect after POST: `redirect()->route()`

**Acceptance Criteria:**
- [ ] Form includes: company (required), role (required), offer_url (optional/url), status (required), priority (required), notes (optional), applied_at (required/date)
- [ ] `StoreCandidatureRequest` handles all validation — no `$request->validate()` in the controller
- [ ] Submitting invalid data shows field-level error messages
- [ ] On success, user is redirected to the candidature detail page with a success flash message
- [ ] Created candidature is linked to the authenticated user (`user_id`)
- [ ] Form has `@csrf`

---

### TASK-07 — View candidature detail (US4)

**Label:** `candidature`
**Priority:** High
**Estimate:** 1h

**Description:**
Build the detail page for a single candidature, showing all its fields and all associated interviews.

**Concepts to know:**
- Route model binding: `show(Candidature $candidature)` — how Laravel resolves it automatically
- Eager loading: `$candidature->load('entretiens')` or via route model binding with `->with()`
- Policy authorization in the controller: `$this->authorize('view', $candidature)`
- Displaying relationships in Blade: `@foreach($candidature->entretiens as $entretien)`

**Acceptance Criteria:**
- [ ] All candidature fields are displayed on the page
- [ ] All associated interviews are listed below the candidature details
- [ ] A user cannot view another user's candidature (Policy blocks it — 403 returned)
- [ ] Empty state shown if no interviews are attached yet
- [ ] Route is named (`candidatures.show`)

---

### TASK-08 — Edit a candidature (US5)

**Label:** `candidature`
**Priority:** High
**Estimate:** 1h

**Description:**
Build the edit form and update logic for an existing candidature. Reuse the Form Request pattern with an update-specific class.

**Concepts to know:**
- `php artisan make:request UpdateCandidatureRequest`
- HTML method spoofing: `@method('PUT')` or `@method('PATCH')` in Blade forms
- Route model binding in `edit()` and `update()` controller methods
- Policy: `authorize('update', $candidature)` — blocks other users
- Repopulating form fields with `old()` helper and current model values

**Acceptance Criteria:**
- [ ] Edit form is pre-filled with the candidature's current values
- [ ] `UpdateCandidatureRequest` validates all fields — no `$request->validate()` in controller
- [ ] A user cannot edit another user's candidature (Policy — 403)
- [ ] On success, user is redirected to the detail page with a success flash message
- [ ] Form uses `@method('PUT')` and `@csrf`
- [ ] Route is named (`candidatures.edit`, `candidatures.update`)

---

### TASK-09 — Archive and restore a candidature (US6, US7, US8)

**Label:** `candidature`
**Priority:** High
**Estimate:** 1h30

**Description:**
Implement soft delete for archiving candidatures and restoration to the active list. Build the dedicated archives page.

**Concepts to know:**
- `SoftDeletes` trait: what `deleted_at` does, how `->delete()` becomes a soft delete
- `Candidature::withTrashed()` and `Candidature::onlyTrashed()` — when to use each
- `->restore()` method on a soft-deleted model
- Route model binding with soft-deleted records: need `withTrashed()` or `->resolveRouteBindingQuery()`
- Separate controller methods for archive, restore (can use `destroy` for archive, custom `restore` route)
- Policy checks on archived records

**Acceptance Criteria:**
- [ ] Archiving a candidature sets `deleted_at` and removes it from the active list
- [ ] Archived candidatures appear exclusively on the `/archives` page
- [ ] Restore button moves a candidature back to the active list (`deleted_at = null`)
- [ ] A user cannot archive or restore another user's candidature (Policy)
- [ ] Active list never shows archived records
- [ ] Routes are named (`candidatures.archive`, `candidatures.restore`, `candidatures.archived`)

---

### TASK-10 — Filter candidatures by status and priority (US9)

**Label:** `candidature`
**Priority:** Medium
**Estimate:** 1h

**Description:**
Add filtering to the candidatures index page so users can narrow the list by status and/or priority without leaving the page.

**Concepts to know:**
- Reading query string parameters: `$request->query('status')`, `$request->get('priority')`
- Conditional Eloquent query chaining: `->when($status, fn($q) => $q->where('status', $status))`
- HTML `<select>` with `<form method="GET">` — no `@csrf` needed for GET forms
- Preserving filter state in the view: using `request('status')` to keep `<select>` selected
- Named route with query params: `route('candidatures.index', ['status' => 'en_cours'])`

**Acceptance Criteria:**
- [ ] Filter form has dropdowns for status and priority (values in French)
- [ ] Selecting a filter and submitting shows only matching candidatures
- [ ] Both filters can be applied simultaneously
- [ ] Clearing filters (empty selection) shows the full active list
- [ ] Filter state is preserved in the dropdowns after submission
- [ ] Empty state handled with `@forelse` when no results match

---

## 🗓️ EPIC 4 — Interview Management (US10–US11)

---

### TASK-11 — Add an interview to a candidature (US10)

**Label:** `interview`
**Priority:** High
**Estimate:** 1h

**Description:**
Build the form and backend logic to add a new interview linked to a specific candidature.

**Concepts to know:**
- Nested resource routes: `Route::resource('candidatures.entretiens', EntretienController::class)`
- Accessing the parent model in a nested controller: `Candidature $candidature` via route model binding
- `php artisan make:request StoreEntretienRequest`
- Validation rules for `scheduled_at`: `date`, `after:today` (optional business rule)
- Authorization: verify the authenticated user owns the parent `Candidature` before adding an interview

**Acceptance Criteria:**
- [ ] Form includes: type (required), scheduled_at (required/datetime), notes (optional), result (nullable)
- [ ] `StoreEntretienRequest` handles all validation
- [ ] Interview is linked to the correct candidature (`candidature_id`)
- [ ] A user cannot add an interview to another user's candidature
- [ ] On success, redirect to the candidature detail page with a flash message
- [ ] Form uses `@csrf`
- [ ] Route is named (`candidatures.entretiens.store`)

---

### TASK-12 — Edit and delete an interview (US11)

**Label:** `interview`
**Priority:** High
**Estimate:** 1h

**Description:**
Allow a user to edit an interview's details or delete it entirely from a candidature.

**Concepts to know:**
- Nested route model binding: resolving both `Candidature $candidature` and `Entretien $entretien`
- `php artisan make:request UpdateEntretienRequest`
- `@method('DELETE')` for delete forms in Blade
- Hard delete (no soft delete needed on interviews): `$entretien->delete()`
- Authorization: user must own the parent candidature to modify its interviews

**Acceptance Criteria:**
- [ ] Edit form is pre-filled with existing interview values
- [ ] `UpdateEntretienRequest` validates all fields
- [ ] A user cannot edit or delete interviews on another user's candidature (403)
- [ ] Delete removes the interview permanently from the database
- [ ] On edit success, redirect to candidature detail with a flash message
- [ ] On delete, redirect to candidature detail with a confirmation flash message
- [ ] Routes are named (`candidatures.entretiens.edit`, `.update`, `.destroy`)

---

## ⭐ EPIC 5 — Bonus Features

---

### TASK-13 — File attachment on candidature (Bonus)

**Label:** `bonus`
**Priority:** Low
**Estimate:** 1h30

**Description:**
Allow users to upload a file (CV, cover letter, etc.) to a candidature. The file must be downloadable from the detail page and deleted from disk when the candidature is deleted.

**Concepts to know:**
- `Storage::disk('local')` vs `Storage::disk('public')` — when to use each
- `$request->file('attachment')->store(...)` — storing uploaded files
- `storage:link` artisan command — making public storage accessible
- Saving the file path in the database (`file_path` column on `candidatures`)
- `Storage::delete($path)` — programmatic file deletion
- Model events or overriding `deleting` / `forceDeleting` to clean up files
- `response()->download(Storage::path($file))` for serving downloads

**Acceptance Criteria:**
- [ ] Upload input accepts files on the create/edit candidature form
- [ ] File is stored via `Storage::disk` and path saved in the database
- [ ] File is downloadable from the candidature detail page
- [ ] File is deleted from disk when the candidature is (force) deleted
- [ ] Only the owner can download their file
- [ ] Non-file candidatures display no download link (handled gracefully)

---

### TASK-14 — Write Pest tests (Bonus)

**Label:** `bonus`
**Priority:** Low
**Estimate:** 2h

**Description:**
Write Pest feature tests covering the critical paths of the application: authorization via Policy, candidature creation with valid/invalid data, and archive/restore flows.

**Concepts to know:**
- Pest test structure: `it('...', function() { ... })`
- `RefreshDatabase` trait — resetting DB state between tests
- `actingAs($user)` — authenticating a user in a test context
- `User::factory()->create()` and `Candidature::factory()->create()`
- `$this->post(route(...), [...])` and asserting `assertRedirect`, `assertSessionHas`
- `assertDatabaseHas` / `assertDatabaseMissing` — verifying DB state
- Testing authorization: `actingAs($otherUser)->get(route(...))` → `assertForbidden()`

**Acceptance Criteria:**
- [ ] Test: unauthenticated user is redirected from protected routes
- [ ] Test: authenticated user cannot view/edit/delete another user's candidature (403)
- [ ] Test: valid candidature creation stores record and redirects correctly
- [ ] Test: invalid candidature creation returns validation errors
- [ ] Test: archiving a candidature sets `deleted_at`
- [ ] Test: restoring a candidature clears `deleted_at`
- [ ] `php artisan test` passes with all tests green

---

## 📦 EPIC 6 — Deliverables & Documentation

---

### TASK-15 — Write README with installation instructions

**Label:** `deliverable`
**Priority:** High
**Estimate:** 30min

**Description:**
Write a complete `README.md` so that any developer can clone and run the project from scratch.

**Concepts to know:**
- Standard Laravel setup steps: clone, `composer install`, `.env` copy, `APP_KEY`, migrate, storage link
- Documenting environment variables
- Markdown formatting for code blocks and step-by-step instructions

**Acceptance Criteria:**
- [ ] README includes: project description, prerequisites (PHP version, Composer, Node)
- [ ] Step-by-step installation from `git clone` to `php artisan serve`
- [ ] `.env` setup instructions with required variables listed
- [ ] `php artisan storage:link` mentioned if file storage bonus is implemented
- [ ] Test command documented (`php artisan test`)

---

### TASK-16 — Set up Jira board and populate all tickets

**Label:** `deliverable`
**Priority:** Highest
**Estimate:** 30min
**Due:** Monday 18/05 before 16:00

**Description:**
Create the Jira project, configure columns (To Do / In Progress / In Review / Done), and create one ticket per User Story. Share the board with the trainer before the deadline.

**Acceptance Criteria:**
- [ ] Jira board created and shared before Monday 16:00
- [ ] One ticket exists for each US (US1–US11) and each bonus
- [ ] All tickets have been moved at least once during the week (visible history)
- [ ] Tickets have labels, priorities, and descriptions filled in

---

### TASK-17 — Prepare MCD & MLD document for submission

**Label:** `deliverable`
**Priority:** Highest
**Estimate:** 30min
**Due:** Monday 18/05 before 16:00

**Description:**
Export and submit the finalized MCD and MLD (from TASK-02) in the required format before the deadline.

**Acceptance Criteria:**
- [ ] MCD exported as image or PDF
- [ ] MLD exported as image or PDF
- [ ] Both submitted/shared before Monday 16:00
- [ ] Entities, attributes, cardinalities, and foreign keys are clearly labeled

---

### TASK-18 — Prepare presentation slides

**Label:** `deliverable`
**Priority:** Medium
**Estimate:** 1h

**Description:**
Build the slides for the 10-minute presentation + demo session. Cover context, architecture, technical decisions, and difficulties.

**Structure to follow:**
1. Project context & problem statement
2. MCD / MLD walkthrough
3. Architecture overview (routes, controllers, models, policies)
4. Key technical decisions (why Breeze, Form Requests, Soft Deletes, Policy)
5. Live demo flow outline
6. Difficulties encountered & solutions

**Acceptance Criteria:**
- [ ] Slides cover all 6 sections above
- [ ] MCD and MLD are embedded and readable
- [ ] No more than 10 slides (concise)
- [ ] Demo flow is scripted and rehearsed (no blocking bugs during demo)
