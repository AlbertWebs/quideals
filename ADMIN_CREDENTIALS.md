# Admin Panel Access

- **Login URL:** `/login`
- **Admin Dashboard:** `/admin`

After signing in, change your password from **Change Password** in the admin account menu (`/admin/password`).

## Creating Admin Users

To create or update admin users, run:

```bash
php artisan db:seed --class=AdminUserSeeder
```

If no users exist, the seeder creates an initial admin account. Change that password immediately after first login.
