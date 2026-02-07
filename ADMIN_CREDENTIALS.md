# Admin Panel Credentials

## Default Admin Account

**Email:** `admin@quideals.co.ke`  
**Password:** `Password@123`

## Access

- **Login URL:** `/login`
- **Admin Dashboard:** `/admin`

## Creating Admin Users

To create or update admin users, run the seeder:

```bash
php artisan db:seed --class=AdminUserSeeder
```

The seeder will:
1. Check if any users exist
2. If users exist, make the first user an admin
3. If no users exist, create a new admin user with the credentials above

## Security Notes

⚠️ **Important:** Change the default password after first login in production environments.

## Features Available

Once logged in as admin, you can:
- ✅ Manage Products (Create, Edit, Delete)
- ✅ Manage Categories (Create, Edit, Delete)
- ✅ Manage Brands (Create, Edit, Delete)
- ✅ View and manage Orders
- ✅ Manage Users
- ✅ Configure Settings
- ✅ Manage FAQs
- ✅ View Contact Messages
- ✅ Manage Carousel Slides

## Mobile Support

The admin panel is now fully mobile-friendly. You can:
- Add, edit, or delete Brands, Categories, and Products on mobile devices
- All forms are optimized for touch interactions
- Tables automatically convert to card layouts on mobile screens
