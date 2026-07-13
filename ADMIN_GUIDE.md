# PCG Monninger - Admin Dashboard Guide

## 🔐 Admin Login Access

### Default Login Credentials

**Admin Account:**
- **URL:** `http://localhost/pcgmonninger/dashboard/login` (or your configured domain)
- **Email:** `admin@example.com`
- **Password:** Contact system administrator

**Alternative Admin Account (if seeded):**
- **Email:** `admin@pcgmonninger.com`
- **Password:** `password123`

**Editor Account (if seeded):**
- **Email:** `editor@pcgmonninger.com`
- **Password:** `password123`

> ⚠️ **IMPORTANT:** Change these default passwords immediately after first login!

---

## 🚀 Quick Start

### 1. Access the Dashboard

Navigate to: `http://localhost/pcgmonninger/dashboard/login`

### 2. Login with Your Credentials

Enter your email and password, then click "Login to Dashboard"

### 3. Dashboard Features

Once logged in, you'll have access to manage:

- **📰 Blog Posts / News Updates** - Create and manage church news
- **🎤 Sermons** - Upload and manage sermon content (audio/video)
- **⛪ Ministries** - Manage church ministries and programs
- **📸 Media Gallery** - Upload and organize photos
- **📅 Events** - Create and manage church events
- **🙏 Prayer Requests** - View and respond to prayer requests
- **✉️ Contact Messages** - Manage contact form submissions
- **👥 Users** - Manage dashboard users (Admin only)

---

## 👤 User Roles & Permissions

### Admin
- Full access to all features
- Can create/edit/delete all content
- Can manage users and assign roles
- Can access user management section

### Editor
- Can create/edit/delete content (blog, sermons, events, ministries, media)
- Can view and manage prayer requests
- Can view and respond to contact messages
- Cannot manage users

### Viewer
- Read-only access to dashboard
- Can view statistics and content
- Cannot create, edit, or delete content

---

## 🛠️ Creating New Admin Users

### Method 1: Using Artisan Command (Recommended)

```bash
# Interactive mode
php artisan admin:create

# With parameters
php artisan admin:create --name="John Doe" --email="john@example.com" --password="securepass123" --role=admin
```

### Method 2: Using Database Seeder

```bash
# Run the seeder to create default users
php artisan db:seed --class=UserSeeder
```

This creates:
- `admin@pcgmonninger.com` / `password123` (Admin)
- `editor@pcgmonninger.com` / `password123` (Editor)

### Method 3: Through Dashboard (Admin Only)

1. Login as an admin
2. Navigate to **Users** section
3. Click **"New User"** or **"Register"**
4. Fill in user details and select role
5. Click **"Create User"**

---

## 📝 Managing Website Sections

### Blog Posts / News Updates

1. Go to **Blog Posts** in the sidebar
2. Click **"New Blog Post"**
3. Fill in:
   - Title
   - Content (rich text editor)
   - Featured image
   - Category
   - Publish status
4. Click **"Save"**

### Sermons

1. Go to **Sermons** in the sidebar
2. Click **"New Sermon"**
3. Fill in:
   - Title
   - Speaker name
   - Date
   - Description
   - Audio URL (optional)
   - Video URL (optional)
   - Featured image
4. Click **"Save"**

### Ministries

1. Go to **Ministries** in the sidebar
2. Click **"New Ministry"**
3. Fill in:
   - Ministry name
   - Description
   - Leader/Contact person
   - Meeting schedule
   - Image
4. Click **"Save"**

### Media Gallery

1. Go to **Media Gallery** in the sidebar
2. Click **"Upload Media"**
3. Select image file
4. Add title and description
5. Choose category
6. Click **"Upload"**

### Events

1. Go to **Events** in the sidebar
2. Click **"New Event"**
3. Fill in:
   - Event name
   - Date and time
   - Location
   - Description
   - Featured image
4. Click **"Save"**

---

## 🔧 Common Tasks

### Changing Your Password

1. Click on your name in the top-right corner
2. Select **"Profile"**
3. Scroll to **"Change Password"** section
4. Enter current password and new password
5. Click **"Update Password"**

### Updating Your Profile

1. Click on your name in the top-right corner
2. Select **"Profile"**
3. Update your name or email
4. Click **"Update Profile"**

### Publishing/Unpublishing Content

Most content types have a toggle button to quickly publish or unpublish:
- Look for the **"Published"** toggle switch
- Or use the **"Toggle Publish"** button in the actions column

### Featuring Content

To feature sermons, events, or media:
- Click the **"Toggle Featured"** button
- Featured items appear prominently on the website

---

## 🔒 Security Best Practices

1. **Change Default Passwords** - Always change default passwords immediately
2. **Use Strong Passwords** - Minimum 8 characters with mixed case, numbers, and symbols
3. **Logout When Done** - Always logout when finished, especially on shared computers
4. **Regular Updates** - Keep user information up to date
5. **Role Management** - Only assign admin role to trusted users
6. **Monitor Activity** - Regularly review user accounts and deactivate unused ones

---

## 🆘 Troubleshooting

### Cannot Login

**Issue:** "Invalid credentials" error

**Solutions:**
1. Verify email and password are correct
2. Check if account is active (contact admin)
3. Try password reset (if implemented)
4. Check database for user existence:
   ```bash
   php artisan tinker
   >>> App\Models\User::where('email', 'your@email.com')->first()
   ```

### "Unauthorized" Error

**Issue:** Getting "Unauthorized" message when accessing certain features

**Solutions:**
1. Check your user role (Admin, Editor, or Viewer)
2. Some features require Admin privileges
3. Contact administrator to update your role if needed

### Cannot Upload Images

**Issue:** Image upload fails

**Solutions:**
1. Check file size (max 2MB for most images, 5MB for gallery)
2. Ensure file is a valid image format (JPG, PNG, GIF, etc.)
3. Check storage permissions:
   ```bash
   chmod -R 775 storage
   chmod -R 775 public/storage
   ```
4. Ensure storage link exists:
   ```bash
   php artisan storage:link
   ```

### Session Expired

**Issue:** Getting logged out frequently

**Solutions:**
1. Check "Remember me" when logging in
2. Increase session lifetime in `.env`:
   ```
   SESSION_LIFETIME=120
   ```

---

## 📞 Support

For technical support or questions:
- Contact your system administrator
- Check application logs: `storage/logs/laravel.log`
- Review this guide for common solutions

---

## 🔄 Database Management

### Running Migrations

```bash
# Run all pending migrations
php artisan migrate

# Check migration status
php artisan migrate:status
```

### Seeding Data

```bash
# Seed all data
php artisan db:seed

# Seed specific seeder
php artisan db:seed --class=UserSeeder
```

### Backup Recommendations

Regular backups are essential:
1. **Database:** Export MySQL database regularly
2. **Uploaded Files:** Backup `storage/app/public` and `public/storage`
3. **Configuration:** Backup `.env` file (securely)

---

## 📊 Dashboard Statistics

The dashboard home page shows:
- Total blog posts
- Total sermons
- Total events
- Total ministries
- Gallery items count
- Unanswered prayer requests
- New contact messages
- Active users (admin only)

---

## ✅ Checklist for New Admins

- [ ] Login with provided credentials
- [ ] Change default password
- [ ] Update profile information
- [ ] Familiarize yourself with dashboard layout
- [ ] Test creating a blog post
- [ ] Test uploading an image to gallery
- [ ] Review existing content
- [ ] Understand your role permissions
- [ ] Bookmark the dashboard URL
- [ ] Save this guide for reference

---

**Last Updated:** November 2024  
**Version:** 1.0
