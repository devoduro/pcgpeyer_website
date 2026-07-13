# Leadership Management System - Setup Complete ✓

## Overview
Enhanced leadership CRUD management system with independent year and title management. Admins can now:
- Create and manage leadership years independently
- Create and manage leadership titles/positions independently  
- Assign leaders to specific years using dropdown selectors
- Assign leaders specific titles from predefined list with fallback to custom text

## Database Structure

### New Tables Created

#### `leadership_years`
Stores predefined years for leadership terms:
- `id` (Primary Key)
- `year` (Integer, Unique) - The year value (e.g., 2024)
- `description` (Text, Nullable) - Optional year description (e.g., "Church Year 2024-2025")
- `active` (Boolean) - Whether this year is available for selection
- `timestamps` - Created/updated timestamps

#### `leadership_titles`
Stores predefined titles and positions:
- `id` (Primary Key)
- `title` (String, Unique) - The title name (e.g., "Session Clerk")
- `description` (Text, Nullable) - Optional title description
- `active` (Boolean) - Whether this title is available for selection
- `timestamps` - Created/updated timestamps

#### `leadership` (Modified)
Updated leadership table with new fields:
- `title_id` (Foreign Key) - Links to leadership_titles table
- `title_text` (String) - Fallback custom title text (required field)
- Removed: `is_current` field (replaced with year-based filtering)

## File Changes

### Models Created
1. **`app/Models/LeadershipYear.php`**
   - `scopeActive()` - Get active years ordered by year DESC
   - `scopeOrdered()` - Get all years ordered by year DESC
   - `leaders()` - Relationship to get leadership members in this year

2. **`app/Models/LeadershipTitle.php`**
   - `scopeActive()` - Get active titles ordered alphabetically
   - `scopeOrdered()` - Get all titles ordered alphabetically
   - `leaders()` - Relationship to get leadership members with this title

### Models Modified
1. **`app/Models/Leadership.php`**
   - Added `title_id` and `title_text` to fillable array
   - Added `titleRelation()` - BelongsTo relationship to LeadershipTitle
   - Added `getDisplayTitleAttribute()` - Accessor for displaying title (prefers linked title, falls back to title_text)

### Controllers
1. **`app/Http/Controllers/Dashboard/LeadershipController.php`** - Enhanced with methods:
   - `manageYears()` - Display manage years page
   - `storeYear()` - Create new leadership year
   - `updateYear()` - Update existing leadership year
   - `toggleYear()` - Toggle year active status
   - `deleteYear()` - Delete year (only if no leaders assigned)
   - `manageTitles()` - Display manage titles page
   - `storeTitle()` - Create new leadership title
   - `updateTitle()` - Update existing leadership title
   - `toggleTitle()` - Toggle title active status
   - `deleteTitle()` - Delete title (only if no leaders assigned)
   - Updated `create()` and `edit()` to pass years and titles to views

### Views Created
1. **`resources/views/dashboard/leadership/manage-years.blade.php`**
   - Form to add new year with year and description fields
   - Table listing all years with:
     - Year number
     - Description
     - Member count using the year
     - Active/Inactive status
     - Edit/Activate/Deactivate/Delete actions
   - Edit modal for inline editing
   - Responsive design matching dashboard theme

2. **`resources/views/dashboard/leadership/manage-titles.blade.php`**
   - Form to add new title with title and description fields
   - Table listing all titles with:
     - Title name
     - Description
     - Member count using the title
     - Active/Inactive status
     - Edit/Activate/Deactivate/Delete actions
   - Edit modal for inline editing
   - Responsive design matching dashboard theme

### Views Modified
1. **`resources/views/dashboard/leadership/create.blade.php`**
   - Title field: Replaced text input with dropdown selector showing LeadershipTitle options
   - Added custom title text field (required fallback)
   - Year field: Replaced text input with dropdown selector showing LeadershipYear options
   - Added link to "Manage years" page for quick access

2. **`resources/views/dashboard/leadership/edit.blade.php`**
   - Same changes as create view
   - Pre-selects current year and title in dropdowns
   - Shows current image preview

3. **`resources/views/dashboard/index.blade.php`**
   - Added "Manage Years" quick link in dashboard
   - Added "Manage Titles" quick link in dashboard
   - Links appear in the Content Management section

### Migrations
1. **`database/migrations/2025_12_06_000010_create_leadership_years_table.php`**
   - Creates leadership_years table

2. **`database/migrations/2025_12_06_000011_create_leadership_titles_table.php`**
   - Creates leadership_titles table
   - Adds title_id FK to leadership table
   - Renames leadership.title to leadership.title_text

### Routes
Updated `routes/dashboard.php` with leadership management routes:
```php
Route::get('leadership/manage-years', [...manageYears])
Route::post('leadership/manage-years', [...storeYear])
Route::put('leadership/manage-years/{year}', [...updateYear])
Route::post('leadership/manage-years/{year}/toggle', [...toggleYear])
Route::delete('leadership/manage-years/{year}', [...deleteYear])

Route::get('leadership/manage-titles', [...manageTitles])
Route::post('leadership/manage-titles', [...storeTitle])
Route::put('leadership/manage-titles/{title}', [...updateTitle])
Route::post('leadership/manage-titles/{title}/toggle', [...toggleTitle])
Route::delete('leadership/manage-titles/{title}', [...deleteTitle])
```

## Workflow

### Creating a Leadership Member
1. Go to Dashboard → New Leader or /dashboard/leadership/create
2. Select year from dropdown (populated from leadership_years table)
3. Select title from dropdown (populated from leadership_titles table)
4. Enter custom title text as fallback (required)
5. Fill in other fields (name, email, phone, bio, image, etc.)
6. Submit to create member

### Managing Years
1. Go to Dashboard → Manage Years or /dashboard/leadership/manage-years
2. Add new year: Enter year number and optional description, click "Add Year"
3. Edit existing year: Click "Edit" in modal
4. Activate/Deactivate: Click "Activate" or "Deactivate" toggle
5. Delete: Click "Delete" (only allowed if no leaders use this year)

### Managing Titles
1. Go to Dashboard → Manage Titles or /dashboard/leadership/manage-titles
2. Add new title: Enter title and optional description, click "Add Title"
3. Edit existing title: Click "Edit" in modal
4. Activate/Deactivate: Click "Activate" or "Deactivate" toggle
5. Delete: Click "Delete" (only allowed if no leaders use this title)

## Initial Data
Sample data seeded during setup:
- **Years**: 2024, 2023, 2022 (with descriptions)
- **Titles**: Session Clerk, Treasurer, Moderator, Deacon, Elder (with descriptions)
- **Admin User**: admin@pcgmonninger.com / password

## Features

### Data Validation
- Year: Integer between 1900-2100
- Title: Unique string, max 255 characters
- Description: Optional text field
- Active status: Boolean toggle
- Prevention of deletion if linked records exist

### Accessibility
- Dropdown selectors show title/description for clarity
- Year selection filtered by active status
- Title selection filtered by active status
- Quick access links in dashboard
- Responsive modals for editing
- Inline edit functionality

### Error Handling
- Cannot delete year with assigned leaders
- Cannot delete title with assigned leaders
- Form validation on both client and server side
- User-friendly error messages

## Testing URLs
- Dashboard: `http://127.0.0.1:8001/dashboard`
- Leadership List: `http://127.0.0.1:8001/dashboard/leadership`
- Create Leader: `http://127.0.0.1:8001/dashboard/leadership/create`
- Manage Years: `http://127.0.0.1:8001/dashboard/leadership/manage-years`
- Manage Titles: `http://127.0.0.1:8001/dashboard/leadership/manage-titles`
- Website View: `http://127.0.0.1:8001/about/leadership`

## Database Migrations
All migrations have been executed successfully:
```
✓ 2025_12_06_000010_create_leadership_years_table
✓ 2025_12_06_000011_create_leadership_titles_table
```

## Caching & Performance
- View cache cleared for fresh rendering
- Config cache cleared for updated routes
- LeadershipYear and LeadershipTitle scopes optimized for active filtering
- Leadership model now has title relationship with fallback

---
**Setup completed successfully!** The enhanced leadership management system is ready to use.
