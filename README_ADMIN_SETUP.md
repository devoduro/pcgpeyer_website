# PCG Monninger - Admin System Setup Complete ✅

## 🎉 Admin System Status: READY

Your admin dashboard system has been successfully configured and is ready to use!

---

## 🔐 Current Admin Credentials

**Primary Admin Account:**
- **Email:** `admin@example.com`
- **Password:** `Admin@123`
- **Role:** Admin (Full Access)

> ⚠️ **SECURITY NOTICE:** Please change this password immediately after first login!

---

## 🚀 Quick Start Guide

### 1. Access the Dashboard

**URL:** `http://localhost/pcgmonninger/dashboard/login`

Or if using XAMPP: `http://localhost:8080/pcgmonninger/dashboard/login` (depending on your Apache configuration)

### 2. Login Steps

1. Open your web browser
2. Navigate to the dashboard login URL
3. Enter the credentials above
4. Click "Login to Dashboard"
5. You'll be redirected to the dashboard home page

### 3. Change Your Password (Recommended)

1. Click on your name in the top-right corner
2. Select "Profile"
3. Scroll to "Change Password" section
4. Enter current password: `Admin@123`
5. Enter and confirm your new password
6. Click "Update Password"

---

## 📊 Available Features

Your dashboard provides full CRUD (Create, Read, Update, Delete) capabilities for:

### ✅ Content Management
- **📰 Blog Posts / News** - Manage church news and updates
- **🎤 Sermons** - Upload and manage sermon content (with audio/video URLs)
- **⛪ Ministries** - Create and manage church ministries
- **📸 Media Gallery** - Upload and organize photos
- **📅 Events** - Schedule and manage church events

### ✅ Communications
- **🙏 Prayer Requests** - View and respond to prayer requests
- **✉️ Contact Messages** - Manage contact form submissions

### ✅ Administration (Admin Only)
- **👥 User Management** - Create and manage dashboard users
- **🔐 Role Assignment** - Assign roles (Admin, Editor, Viewer)

---

## 👥 User Management

### Creating Additional Users

#### Method 1: Using Artisan Command (Recommended)

```bash
# Interactive mode
php artisan admin:create

# With parameters
php artisan admin:create \
  --name="John Doe" \
  --email="john@pcgmonninger.com" \
  --password="SecurePass123" \
  --role=editor
```

#### Method 2: Using Database Seeder

```bash
# Creates default admin and editor accounts
php artisan db:seed --class=UserSeeder
```

This creates:
- `admin@pcgmonninger.com` / `password123` (Admin)
- `editor@pcgmonninger.com` / `password123` (Editor)

#### Method 3: Through Dashboard

1. Login as admin
2. Go to "Users" in the sidebar
3. Click "New User"
4. Fill in user details
5. Select role and click "Create"

### Resetting User Passwords

```bash
# Interactive mode
php artisan admin:reset-password user@example.com

# With password parameter
php artisan admin:reset-password user@example.com --password="NewPass123"
```

---

## 🎭 User Roles Explained

### Admin (Full Access)
- ✅ Create, edit, delete all content
- ✅ Manage users and assign roles
- ✅ Access all dashboard features
- ✅ View all statistics

### Editor (Content Manager)
- ✅ Create, edit, delete content (blog, sermons, events, etc.)
- ✅ Manage prayer requests and contact messages
- ❌ Cannot manage users
- ✅ View content statistics

### Viewer (Read-Only)
- ✅ View dashboard and statistics
- ❌ Cannot create, edit, or delete content
- ❌ Cannot manage users
- ✅ Read-only access

---

## 🛠️ Useful Commands

### Check System Health

```bash
php check-admin-system.php
```

This script checks:
- Laravel installation
- File permissions
- Required files
- Database migrations
- Storage links

### Database Operations

```bash
# Check migration status
php artisan migrate:status

# Run migrations (if needed)
php artisan migrate

# Seed database with default users
php artisan db:seed --class=UserSeeder

# Create storage link (if not exists)
php artisan storage:link
```

### User Management

```bash
# List all admin commands
php artisan list admin

# Create new admin user
php artisan admin:create

# Reset user password
php artisan admin:reset-password admin@example.com
```

### View All Users

```bash
php artisan tinker --execute="App\Models\User::all(['id', 'name', 'email', 'role', 'is_active'])->each(function(\$u) { echo 'ID: ' . \$u->id . ' | ' . \$u->name . ' | ' . \$u->email . ' | ' . \$u->role . ' | Active: ' . (\$u->is_active ? 'Yes' : 'No') . PHP_EOL; });"
```

---

## 📁 Project Structure

```
pcgmonninger/
├── app/
│   ├── Console/Commands/
│   │   ├── CreateAdminUser.php       # Create admin users
│   │   └── ResetAdminPassword.php    # Reset passwords
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   └── AuthController.php    # Login/logout
│   │   │   └── Dashboard/
│   │   │       ├── DashboardController.php
│   │   │       ├── BlogPostController.php
│   │   │       ├── SermonController.php
│   │   │       ├── MinistryController.php
│   │   │       ├── MediaController.php
│   │   │       ├── EventController.php
│   │   │       ├── PrayerRequestController.php
│   │   │       ├── ContactController.php
│   │   │       └── UserController.php
│   │   └── Middleware/
│   │       ├── DashboardAuth.php         # Auth middleware
│   │       ├── AdminOnly.php             # Admin-only access
│   │       └── EditorOrAdmin.php         # Editor/Admin access
│   └── Models/
│       └── User.php                      # User model
├── database/
│   ├── migrations/
│   │   └── 2024_01_01_000000_create_users_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── UserSeeder.php
├── resources/views/dashboard/
│   ├── auth/
│   │   └── login.blade.php
│   ├── layouts/
│   │   └── app.blade.php
│   ├── blog/
│   ├── sermons/
│   ├── ministries/
│   ├── media/
│   ├── events/
│   ├── prayer-requests/
│   ├── contact/
│   ├── users/
│   ├── index.blade.php
│   └── profile.blade.php
├── routes/
│   ├── web.php
│   └── dashboard.php                     # All dashboard routes
├── ADMIN_GUIDE.md                        # Comprehensive admin guide
├── README_ADMIN_SETUP.md                 # This file
└── check-admin-system.php                # Health check script
```

---

## 🔧 Troubleshooting

### Cannot Login

**Problem:** "Invalid credentials" error

**Solutions:**
1. Verify email: `admin@example.com`
2. Verify password: `Admin@123`
3. Check if user exists:
   ```bash
   php artisan tinker --execute="App\Models\User::where('email', 'admin@example.com')->first()"
   ```
4. Reset password:
   ```bash
   php artisan admin:reset-password admin@example.com
   ```

### "Page Not Found" Error

**Problem:** Dashboard URL returns 404

**Solutions:**
1. Check Apache is running in XAMPP
2. Verify URL path matches your installation
3. Check `.htaccess` file exists in public directory
4. Verify routes:
   ```bash
   php artisan route:list --name=dashboard
   ```

### "Unauthorized" Error

**Problem:** Getting "Unauthorized" when accessing features

**Solutions:**
1. Check your user role (Admin, Editor, or Viewer)
2. Some features require Admin privileges
3. Verify middleware is working:
   ```bash
   php artisan route:list --name=dashboard.users
   ```

### Cannot Upload Images

**Problem:** Image upload fails

**Solutions:**
1. Check storage link exists:
   ```bash
   php artisan storage:link
   ```
2. Verify permissions:
   ```bash
   chmod -R 775 storage
   chmod -R 775 public/storage
   ```
3. Check file size (max 2MB for most, 5MB for gallery)

### Session Expired Frequently

**Problem:** Getting logged out too often

**Solutions:**
1. Check "Remember me" when logging in
2. Increase session lifetime in `.env`:
   ```env
   SESSION_LIFETIME=120
   ```

---

## 🔒 Security Recommendations

1. **Change Default Passwords**
   - Change `Admin@123` immediately after first login
   - Use strong passwords (min 8 chars, mixed case, numbers, symbols)

2. **Secure Your .env File**
   - Never commit `.env` to version control
   - Set proper file permissions: `chmod 600 .env`

3. **Regular Backups**
   - Backup database regularly
   - Backup uploaded files in `storage/app/public`

4. **User Management**
   - Only assign Admin role to trusted users
   - Deactivate unused accounts
   - Review user list periodically

5. **HTTPS in Production**
   - Always use HTTPS in production
   - Update APP_URL in `.env` to use https://

---

## 📚 Additional Resources

- **Full Admin Guide:** See `ADMIN_GUIDE.md` for detailed feature documentation
- **Laravel Documentation:** https://laravel.com/docs
- **Health Check:** Run `php check-admin-system.php` anytime

---

## ✅ System Verification

Run this command to verify everything is working:

```bash
php check-admin-system.php
```

Expected output: "✅ All checks passed!"

---

## 🎯 Next Steps

1. ✅ Login to dashboard with provided credentials
2. ✅ Change your password
3. ✅ Explore the dashboard features
4. ✅ Create a test blog post
5. ✅ Upload a test image to gallery
6. ✅ Create additional users if needed
7. ✅ Read `ADMIN_GUIDE.md` for detailed instructions

---

## 📞 Support

If you encounter any issues:

1. Run the health check: `php check-admin-system.php`
2. Check Laravel logs: `storage/logs/laravel.log`
3. Verify database connection in `.env`
4. Review this guide and `ADMIN_GUIDE.md`

---

**System Status:** ✅ Fully Operational  
**Last Updated:** November 2024  
**Version:** 1.0

---

## 🎊 You're All Set!

Your admin dashboard is ready to use. Login and start managing your church website content!

**Dashboard URL:** http://localhost/pcgmonninger/dashboard/login  
**Email:** admin@example.com  
**Password:** Admin@123

Happy managing! 🚀
