 

## SmartVote — roles overview

This document maps the key files that implement role-based separation (Admin vs Student) and explains the login redirect flow in a concise, readable format.

📁 SmartVote/
├─ 📁 app/F
│  ├─ 📁 Enum/
│  │  └─ 🔖 `UserRole.php` — enum defining roles (ADMIN, STUDENT)
│  ├─ 📁 Models/
│  │  └─ 👤 `User.php` — User model with helper methods `isAdmin()` and `isStudent()` and `role` attribute
│  └─ 📁 Http/
│     └─ Controllers/ — controllers (e.g. `ProfileController`)
├─ 📁 database/
│  └─ 📁 seeders/
│     └─ 🌱 `AdminStudentSeeder.php` — creates/upserts an admin and a student user with roles
├─ 📁 resources/views/
│  ├─ 📁 Admin/
│  │  └─ 🖥 `adminDashboard.blade.php` — admin UI view
│  └─ 📁 Student/
│     └─ 🖥 `studentDashboard.blade.php` — student UI view
├─ 📄 `routes/web.php` — contains the redirect logic from `/dashboard` to admin or student dashboards
└─ other standard Laravel files (composer.json, package.json, phpunit.xml...)
 `routes/web.php` — contains the `/dashboard` redirect logic

---

### How roles are defined

The project uses a small, focused enum at `app/Enum/UserRole.php`:

- ADMIN => `'admin'`
- STUDENT => `'student'`

This keeps role strings consistent across the codebase and offers an easy place to add labels or helpers.

### How roles are stored and checked

- The `users` table contains a `role` column.
- `app/Models/User.php` exposes `role` in `$fillable` and provides two convenience methods:
  - `isAdmin(): bool` — true when `role === UserRole::ADMIN->value`.
  - `isStudent(): bool` — true when `role === UserRole::STUDENT->value`.

These helpers make controller and blade checks readable:

```php
if (auth()->user()->isAdmin()) {
    // admin logic
}
```

### How roles get assigned

- The seeder `database/seeders/AdminStudentSeeder.php` upserts two users and assigns `role` using `UserRole::...->value`.
- If you have a registration endpoint (not included here), set the default `role` there (usually `UserRole::STUDENT->value`).

### Login → Dashboard redirect (what happens after sign-in)

The `/dashboard` route in `routes/web.php` is protected with `auth` (and `verified` in the default route). After successful login it:

1. Loads the authenticated user: `$user = Auth::user();`
2. Reads `$role = $user?->role ?? 'student'` (falls back to `student` if role missing)
3. If the value equals `'admin'` it redirects to the admin dashboard route (`admin.index` → `/admin/dashboard`)
4. Otherwise it redirects to the student dashboard route (`student.index` → `/student/dashboard`)

This simple branching is readable and straightforward, but can be improved for maintainability (see suggestions).

### Suggestions (small improvements)

- Add an `IsAdmin` middleware to protect admin routes. Example benefits:
  - Clear intent in routing (`->middleware('is_admin')`) instead of repeated checks.
  - Central place to return 403s or redirect non-admins.
- Ensure public registrations always set `role` to `UserRole::STUDENT->value` to avoid accidental admin creation.
- If the app grows (more roles or granular permissions), consider using a permission package (Spatie) or a roles table with many-to-many relationships.

---

Files to inspect (quick links):

- `app/Enum/UserRole.php`
- `app/Models/User.php`
- `database/seeders/AdminStudentSeeder.php`
- `routes/web.php`

If you'd like, I can also:

- Implement an `IsAdmin` middleware and register it in `app/Http/Kernel.php`.
- Add a unit test verifying the `/dashboard` redirect behaves correctly for admin vs student.

Status: updated on 2025-09-17
