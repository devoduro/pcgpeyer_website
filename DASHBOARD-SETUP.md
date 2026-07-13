# PCG Monninger Dashboard Setup Guide

## Overview
A comprehensive professional dashboard system for managing church website content including blog posts, sermons, events, ministries, media gallery, prayer requests, and contact submissions with complete CRUD operations and role-based access control.

## Features

### Dashboard Sections
- **News/Blog Management** - Create, edit, delete, and publish blog posts
- **Sermons Management** - Manage sermon recordings, dates, speakers, and featured content
- **Ministries Management** - Organize and maintain ministry information
- **Events Management** - Create and manage church events
- **Media Gallery** - Upload and organize images
- **Prayer Requests** - Track and manage prayer requests
- **Contact Messages** - Review and respond to contact form submissions
- **User Management** (Admin Only) - Create and manage dashboard users

### User Roles
1. **Admin** - Full system access, user management, all content management
2. **Editor** - Content management (posts, sermons, events, gallery, etc.)
3. **Viewer** - Read-only dashboard access

## Installation Steps

### Step 1: Install Dependencies
```bash
cd /Applications/XAMPP/xamppfiles/htdocs/pcgmonninger
composer install
npm install
```

### Step 2: Run Migrations
```bash
php artisan migrate
```

This will create all necessary database tables:
- `users` - Dashboard user accounts
- `blog_posts` - News and blog articles
- `sermons` - Sermon information
- `ministries` - Ministry details
- `events` - Church events
- `media_gallery` - Gallery images
- `prayer_requests` - Prayer requests
- `contact_submissions` - Contact form submissions

### Step 3: Create First Admin User
```bash
php artisan tinker
>>> App\Models\User::create([
    'name' => 'Admin User',
    'email' => 'admin@example.com',
    'password' => 'password123',
    'role' => 'admin',
    'is_active' => true
]);
>>> exit
```

### Step 4: Build Frontend Assets
```bash
npm run dev
# or for production:
npm run build
```

### Step 5: Access Dashboard
Visit: `http://localhost/pcgmonninger/dashboard/login`

**Default Credentials:**
- Email: `admin@example.com`
- Password: `password123`

⚠️ **Important:** Change the default password immediately after first login!

## File Structure

```
resources/views/dashboard/
├── layouts/
│   └── app.blade.php          # Main dashboard layout
├── auth/
│   └── login.blade.php        # Login page
├── blog/
│   ├── index.blade.php        # List posts
│   ├── create.blade.php       # Create form
│   └── edit.blade.php         # Edit form
├── sermons/
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
├── ministries/
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
├── events/
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
├── media/
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
├── prayer-requests/
│   ├── index.blade.php
│   └── show.blade.php
├── contact/
│   ├── index.blade.php
│   └── show.blade.php
├── users/
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
├── index.blade.php            # Dashboard home
└── profile.blade.php          # User profile

app/Http/Controllers/Dashboard/
├── DashboardController.php    # Dashboard home & profile
├── BlogPostController.php     # Blog CRUD
├── SermonController.php       # Sermon CRUD
├── MinistryController.php     # Ministry CRUD
├── EventController.php        # Event CRUD
├── MediaController.php        # Gallery CRUD
├── PrayerRequestController.php # Prayer request management
├── ContactController.php      # Contact submission management
└── UserController.php         # User management

app/Http/Controllers/Auth/
└── AuthController.php         # Authentication logic

app/Models/
├── User.php                   # User model
├── BlogPost.php               # Blog post model
├── Sermon.php                 # Sermon model
├── Ministry.php               # Ministry model
├── Event.php                  # Event model
├── MediaGallery.php           # Media gallery model
├── PrayerRequest.php          # Prayer request model
└── ContactSubmission.php      # Contact submission model

routes/
├── web.php                    # Main routes (updated)
└── dashboard.php              # Dashboard-specific routes

app/Http/Middleware/
├── DashboardAuth.php          # Dashboard authentication check
├── AdminOnly.php              # Admin-only access
└── EditorOrAdmin.php          # Editor and admin access
```

## Database Schema

### Users Table
- id, name, email, password, role (admin/editor/viewer), is_active, timestamps

### Blog Posts
- id, title, slug, excerpt, content, author, image, published, published_at, timestamps

### Sermons
- id, title, slug, speaker, date, description, content, audio_url, video_url, image, featured, published, timestamps

### Ministries
- id, name, slug, description, content, image, leader, contact_email, meeting_schedule, featured, active, timestamps

### Events
- id, title, slug, description, content, image, start_date, end_date, location, organizer, featured, published, timestamps

### Media Gallery
- id, title, description, image_path, category, featured, display_order, uploaded_by, timestamps

### Prayer Requests
- id, name, email, phone, request, category, is_private, is_answered, admin_notes, timestamps

### Contact Submissions
- id, name, email, phone, subject, message, status (new/read/replied/resolved), admin_notes, replied_at, timestamps

## User Management Workflow

### Creating Users
1. Login as Admin
2. Navigate to Users section
3. Click "Add User"
4. Fill in details and assign role
5. New user can login immediately

### Managing User Permissions
- **Admin**: Can access all sections including user management
- **Editor**: Can create and edit content but cannot manage users
- **Viewer**: Can only view dashboard (read-only access)

## Content Management Workflows

### Publishing Blog Posts
1. Dashboard > News/Blog
2. Click "New Post"
3. Fill title, excerpt, content
4. Upload featured image
5. Check "Publish this post"
6. Click "Save Post"

### Adding Sermons
1. Dashboard > Sermons
2. Click "New Sermon"
3. Enter sermon details, speaker name, date
4. Add audio/video URLs
5. Toggle "Published" if ready
6. Save

### Managing Events
1. Dashboard > Events
2. Create with date/time, location
3. Add event details
4. Set start and end dates
5. Toggle featured status

### Uploading Media
1. Dashboard > Gallery
2. Click "Upload Image"
3. Select image file
4. Add title and category
5. Set display order if needed
6. Toggle "Featured" for homepage

### Managing Prayer Requests
1. Dashboard > Prayer Requests
2. View submitted requests
3. Click to view details
4. Add admin notes
5. Mark as answered when complete

### Responding to Contact Messages
1. Dashboard > Contact Messages
2. Click message to view details
3. Type reply in response box
4. Click "Send Reply"
5. Mark "Resolved" when complete

## Security Features

### Authentication
- Secure password hashing using bcrypt
- Session-based authentication
- CSRF token protection on all forms
- Remember me functionality

### Authorization
- Role-based access control (RBAC)
- Middleware protection for routes
- Admin-only user management
- User deactivation capability

### Data Validation
- Server-side validation on all inputs
- File upload restrictions
- Email validation
- Unique constraint enforcement

## Customization Guide

### Adding New Dashboard Sections

1. **Create Migration**:
```bash
php artisan make:migration create_new_section_table
```

2. **Create Model**:
```bash
php artisan make:model NewSection
```

3. **Create Controller**:
```bash
php artisan make:controller Dashboard/NewSectionController --resource
```

4. **Create Views** in `resources/views/dashboard/new-section/`

5. **Add Routes** in `routes/dashboard.php`

### Modifying Dashboard Styling

All styling uses Tailwind CSS. Edit colors in:
- `resources/views/dashboard/layouts/app.blade.php` - Main layout
- Individual view files for specific sections

Color scheme can be customized via Tailwind config.

## Troubleshooting

### Issue: Login page shows blank
**Solution**: Run `php artisan migrate` if you haven't already

### Issue: Images not uploading
**Solution**: Ensure `storage/app/public` is symlinked:
```bash
php artisan storage:link
```

### Issue: Styles not loading
**Solution**: Run `npm run dev` or rebuild with `npm run build`

### Issue: Database connection error
**Solution**: Check `.env` file has correct database credentials

### Issue: Permission denied on storage
**Solution**: Set correct permissions:
```bash
chmod -R 755 storage bootstrap/cache
```

## Best Practices

1. **Regular Backups** - Back up database regularly
2. **Strong Passwords** - Use strong passwords for all user accounts
3. **Content Review** - Review published content before going live
4. **User Management** - Regularly audit active users
5. **Media Management** - Organize media by category
6. **Archive Old Content** - Archive outdated events and posts

## Support

For issues or questions:
1. Check database migrations have run
2. Verify file permissions
3. Clear Laravel cache: `php artisan cache:clear`
4. Check browser console for JavaScript errors
5. Review Laravel logs in `storage/logs/`

## Deployment Checklist

- [ ] Run migrations on production
- [ ] Create admin user
- [ ] Change default password
- [ ] Set up storage symlink
- [ ] Configure environment variables
- [ ] Run asset build
- [ ] Set up SSL certificate
- [ ] Configure backups
- [ ] Set application to production mode
- [ ] Configure email for notifications

---

**Dashboard Version**: 1.0.0  
**Last Updated**: November 2025
