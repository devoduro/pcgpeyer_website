# XAMPP Access Guide for PCG Monninger

## ✅ Correct URLs for XAMPP

Since you're using XAMPP, the Laravel application is served from the `public` directory.

### Dashboard Login URL

**Use this URL:**
```
http://localhost/pcgmonninger/public/dashboard/login
```

### Homepage URL

```
http://localhost/pcgmonninger/public
```

---

## 🔧 Better Solution: Configure Virtual Host

To use cleaner URLs without `/public`, configure a virtual host:

### Step 1: Edit Apache Configuration

Open XAMPP Apache config:
```
/Applications/XAMPP/xamppfiles/etc/extra/httpd-vhosts.conf
```

Add this at the end:

```apache
<VirtualHost *:80>
    ServerName pcgmonninger.local
    DocumentRoot "/Applications/XAMPP/xamppfiles/htdocs/pcgmonninger/public"
    
    <Directory "/Applications/XAMPP/xamppfiles/htdocs/pcgmonninger/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

### Step 2: Edit Hosts File

```bash
sudo nano /etc/hosts
```

Add this line:
```
127.0.0.1   pcgmonninger.local
```

### Step 3: Restart Apache

In XAMPP Control Panel, stop and start Apache.

### Step 4: Access Your Site

Now you can use:
```
http://pcgmonninger.local/dashboard/login
```

---

## 🚀 Alternative: Use PHP Built-in Server

Instead of XAMPP, you can use Laravel's built-in server:

```bash
cd /Applications/XAMPP/xamppfiles/htdocs/pcgmonninger
php artisan serve
```

Then access:
```
http://localhost:8000/dashboard/login
```

---

## 📝 Current Working URLs

**For now, use these URLs with XAMPP:**

- **Dashboard Login:** http://localhost/pcgmonninger/public/dashboard/login
- **Homepage:** http://localhost/pcgmonninger/public
- **Admin Email:** admin@example.com
- **Password:** Admin@123

---

## ⚠️ Common Issues

### "404 Not Found"
- Make sure you include `/public` in the URL
- Check Apache is running in XAMPP

### "500 Internal Server Error"
- Check file permissions: `chmod -R 775 storage bootstrap/cache`
- Check `.env` file exists
- Check logs: `storage/logs/laravel.log`

### "Page not loading"
- Verify Apache is running in XAMPP Control Panel
- Check if port 80 is available
- Try: http://localhost (should show XAMPP dashboard)

---

**Quick Access:** http://localhost/pcgmonninger/public/dashboard/login
