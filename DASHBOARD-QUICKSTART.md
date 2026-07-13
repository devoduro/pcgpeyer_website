# Dashboard Quick Start Guide

## 🚀 Get Started in 5 Minutes

### 1. Run Migrations
```bash
php artisan migrate
```

### 2. Create Admin User
```bash
php artisan tinker
```
Then paste:
```php
App\Models\User::create([
    'name' => 'Admin User',
    'email' => 'admin@example.com',
    'password' => 'password123',
    'role' => 'admin',
    'is_active' => true
]);
exit
```

### 3. Build Assets
```bash
npm run dev
```

### 4. Access Dashboard
Visit: `http://localhost/pcgmonninger/dashboard/login`

Login with:
- Email: `admin@example.com`
- Password: `password123`

---

## 📊 Dashboard Features At a Glance

| Feature | Location | What You Can Do |
|---------|----------|-----------------|
| **News & Blog** | Dashboard > News/Blog | Create, edit, publish articles |
| **Sermons** | Dashboard > Sermons | Add sermon recordings & speaker info |
| **Ministries** | Dashboard > Ministries | Manage ministry programs |
| **Events** | Dashboard > Events | Create and schedule events |
| **Gallery** | Dashboard > Gallery | Upload and organize images |
| **Prayer** | Dashboard > Prayer Requests | Track prayer requests |
| **Messages** | Dashboard > Contact Messages | Respond to inquiries |
| **Users** | Dashboard > Users (Admin Only) | Manage dashboard users |

---

## 👥 User Roles Explained

### 🔴 Admin Role
- Full access to everything
- Can create/edit/delete users
- Can manage all content
- Can deactivate users

### 🟡 Editor Role
- Can create and edit content
- Cannot manage users
- Cannot change settings
- Cannot delete other users' content

### 🔵 Viewer Role
- Read-only access
- Can view all content
- Cannot make changes
- Cannot delete anything

---

## 📝 Common Tasks

### Add a Blog Post
1. Click **Dashboard > News/Blog**
2. Click **New Post**
3. Fill in title, excerpt, content
4. Upload featured image (optional)
5. Check "Publish this post"
6. Click **Save Post**

### Upload Sermon
1. Click **Dashboard > Sermons**
2. Click **New Sermon**
3. Enter title, speaker name
4. Select sermon date
5. Add audio/video URLs (optional)
6. Click **Save Sermon**

### Add Church Event
1. Click **Dashboard > Events**
2. Click **New Event**
3. Enter event title and description
4. Set start and end dates/times
5. Add location and organizer
6. Upload event image
7. Click **Create Event**

### Upload Gallery Image
1. Click **Dashboard > Gallery**
2. Click **Upload Image**
3. Click to select image file
4. Add title and category
5. Toggle "Featured" if needed
6. Click **Upload Image**

### Respond to Prayer Request
1. Click **Dashboard > Prayer Requests**
2. Click prayer request to open it
3. Add notes in "Admin Notes" box
4. Mark as "Answered" when done

### Reply to Contact Message
1. Click **Dashboard > Contact Messages**
2. Click message to view details
3. Type reply in response box
4. Click **Send Reply**
5. Mark as **Resolved** when done

### Create New Dashboard User
1. Click **Dashboard > Users** (Admin only)
2. Click **Add User**
3. Fill in name and email
4. Set password
5. Select user role
6. Click **Create User**

---

## 🔐 Security Tips

✅ **Do:**
- Change default admin password immediately
- Use strong passwords (8+ characters)
- Deactivate unused user accounts
- Review user permissions regularly
- Back up database regularly

❌ **Don't:**
- Share login credentials
- Use simple passwords like "123456"
- Leave users active if they've left
- Click suspicious links in messages
- Store sensitive info in admin notes

---

## ⚡ Keyboard Shortcuts

| Shortcut | Action |
|----------|--------|
| `Escape` | Close alert messages |
| `Tab` | Navigate form fields |
| `Enter` | Submit forms |

---

## 🎨 Dashboard Sections Color Code

- 🔵 **Blog Posts** - Blue
- 🟣 **Sermons** - Purple
- 🔴 **Ministries** - Red
- 🟢 **Events** - Green
- 🟡 **Gallery** - Yellow
- 🩷 **Prayer Requests** - Pink
- 🔷 **Messages** - Indigo
- 🔵 **Users** - Cyan

---

## 📋 File Upload Specifications

| Type | Accepted Formats | Max Size |
|------|------------------|----------|
| Images | PNG, JPG, GIF | 2 MB (blog) / 5 MB (gallery) |
| Audio | MP3, WAV, M4A | 50 MB |
| Video | YouTube/Vimeo URLs | N/A |

---

## 🔧 Troubleshooting

**Can't login?**
- Check email is correct
- Verify password is entered
- Ensure user account is active

**Images not uploading?**
- Check file size limit
- Verify image format
- Check storage permissions

**Styles look broken?**
- Run `npm run dev`
- Clear browser cache
- Try different browser

**Database errors?**
- Run `php artisan migrate`
- Check database connection in `.env`
- Restart XAMPP MySQL

---

## 📞 Need Help?

1. Check the full **DASHBOARD-SETUP.md** guide
2. Review error messages carefully
3. Check Laravel logs: `storage/logs/`
4. Restart your server
5. Clear cache: `php artisan cache:clear`

---

**Welcome to PCG Monninger Dashboard!** 🙏
