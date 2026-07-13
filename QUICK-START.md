# Quick Start Guide - PCG Monninger Website

## Get Running in 5 Minutes!

### Step 1: Install Dependencies (2 minutes)
```bash
cd /Applications/XAMPP/xamppfiles/htdocs/pcgmonninger
composer install
npm install
```

### Step 2: Setup Environment (1 minute)
```bash
cp .env.example .env
php artisan key:generate
```

### Step 3: Database (1 minute)
1. Open http://localhost/phpmyadmin
2. Create database: `pcg_monninger`
3. Done! (No migrations needed for static site)

### Step 4: Build & Run (1 minute)
```bash
npm run build
php artisan serve
```

### Step 5: View Website
Open: **http://localhost:8000**

## That's It! 🎉

Your church website is now running!

## Add Your Logo
Save your church logo as:
```
public/images/logo.png
```

## Need Help?
Read the full INSTALLATION.md file for detailed instructions.

---

**Quick Tips:**
- Use `npm run dev` for development with hot reload
- All pages are already created and working
- Contact form is functional
- Blog has sample posts
- All menus are working

**Pages Available:**
- Home: /
- About: /about/history, /about/staff, /about/leadership, /about/ministers
- Ministries: /ministries/inter-generational, /ministries/generational
- Media: /media/photos, /media/videos
- Contact: /contact
- Blog: /blog

Enjoy your new website! 🙏
