# Database Push Instructions for isoflex.com

## Overview

Push your local WordPress database to the development server (dev.isoflex.com).

**Source:** Local by WPEngine (http://isoflex.local)
**Target:** dev.isoflex.com (Development Server)

---

## ⚠️ IMPORTANT SAFETY NOTES

1. **This OVERWRITES the dev database** - Use with caution!
2. **Automatic backup** - The script creates a timestamped backup before importing
3. **URL replacement** - Automatically replaces `http://isoflex.local` with `https://dev.isoflex.com`
4. **Local site must be running** - Make sure Local by WPEngine is running before pushing

---

## How to Push Database

### Prerequisites

1. **Start your Local site:**
   - Open Local by WPEngine
   - Start the "isoflex" site
   - Verify it's running at http://isoflex.local

2. **Navigate to theme directory:**
   ```bash
   cd "/Users/troycono/Documents/Git Repos/isoflex.com"
   ```

### Push Database Command

```bash
./push-database-to-dev.sh
```

### What the Script Does

1. ✅ **Exports** your local database (local → local_backup.sql)
2. ✅ **Updates URLs** in the dump (isoflex.local → dev.isoflex.com)
3. ✅ **Backs up** remote database (saved to server with timestamp)
4. ✅ **Uploads** the modified dump to dev server
5. ✅ **Imports** database on dev.isoflex.com
6. ✅ **Cleans up** temporary files

---

## Typical Workflow

### Scenario 1: Content Updates (Posts, Pages, Settings)

```bash
# 1. Make changes in Local site (http://isoflex.local)
# 2. Push database to dev
./push-database-to-dev.sh

# 3. If you also have theme changes, deploy those too
./deploy-to-myvesta.sh
```

### Scenario 2: Theme Development Only

```bash
# Just deploy theme files (no database needed)
./deploy-to-myvesta.sh
```

### Scenario 3: Full Deployment (Code + Database)

```bash
# 1. Commit and push code changes
git add -A
git commit -m "Your changes"
git push origin main

# 2. Push database
./push-database-to-dev.sh

# 3. Deploy theme files
./deploy-to-myvesta.sh
```

---

## Database Backups

### Automatic Backups

Every time you run the push script, it creates a backup on the server:

**Location:** `~/backups/dev_isoflex_backup_YYYYMMDD_HHMMSS.sql.gz`

**Example:** `~/backups/dev_isoflex_backup_20241204_143022.sql.gz`

### List Backups on Server

```bash
ssh isoflex_doghouse@isoflex.com "ls -lh ~/backups/"
```

### Restore from Backup

```bash
# 1. SSH into server
ssh isoflex_doghouse@isoflex.com

# 2. List backups
ls -lh ~/backups/

# 3. Restore a specific backup
gunzip < ~/backups/dev_isoflex_backup_YYYYMMDD_HHMMSS.sql.gz | \
mysql -u'isoflex_doghouse_troy' -p'ExG00yIrrp' 'isoflex_doghouse_isoflex'
```

---

## Troubleshooting

### Error: "Failed to export local database"

**Problem:** Local site is not running or database is not accessible

**Solution:**
1. Open Local by WPEngine
2. Start the "isoflex" site
3. Verify you can access http://isoflex.local
4. Try the push script again

### Error: "Failed to upload database dump"

**Problem:** SSH connection issue

**Solution:**
```bash
# Test SSH connection
ssh isoflex_doghouse@isoflex.com "pwd"

# Should return: /home/isoflex_doghouse
```

### Error: "Failed to import database"

**Problem:** Database credentials or permissions issue

**Solution:**
```bash
# Test remote database access
ssh isoflex_doghouse@isoflex.com "mysql -u'isoflex_doghouse_troy' -p'ExG00yIrrp' 'isoflex_doghouse_isoflex' -e 'SHOW TABLES;'"
```

### URLs Not Working After Push

**Problem:** URLs still pointing to local site

**Solution:** The script handles this automatically, but if needed, manually run WP-CLI search-replace:

```bash
ssh isoflex_doghouse@isoflex.com
cd /home/isoflex_doghouse/web/dev.isoflex.com/public_html
# Note: WP-CLI may not be installed on server
```

---

## Manual Database Export/Import

If the script doesn't work, here's the manual process:

### Export from Local

```bash
mysqldump -h"localhost" -u"root" -p"root" "local" > /tmp/local_backup.sql
```

### Upload to Server

```bash
scp /tmp/local_backup.sql isoflex_doghouse@isoflex.com:/tmp/
```

### Import on Server

```bash
ssh isoflex_doghouse@isoflex.com
mysql -u'isoflex_doghouse_troy' -p'ExG00yIrrp' 'isoflex_doghouse_isoflex' < /tmp/local_backup.sql
rm /tmp/local_backup.sql
```

---

## Database Credentials Reference

### Local Database

- **Host:** localhost
- **Database:** local
- **User:** root
- **Password:** root
- **URL:** http://isoflex.local

### Dev Server Database

- **Host:** localhost (on server)
- **Database:** isoflex_doghouse_isoflex
- **User:** isoflex_doghouse_troy
- **Password:** ExG00yIrrp
- **URL:** https://dev.isoflex.com

---

## Quick Reference

```bash
# Push database to dev
./push-database-to-dev.sh

# Deploy theme files to dev
./deploy-to-myvesta.sh

# View server backups
ssh isoflex_doghouse@isoflex.com "ls -lh ~/backups/"

# Access dev site
open https://dev.isoflex.com
```

---

## Important Notes

- ⚠️ **Never push database to production** - This script is for DEV only
- ✅ **Always review changes** before pushing
- ✅ **Backups are automatic** but verify they're working
- ✅ **Test on dev** before any production deployments
- ⚠️ **User accounts** - After push, you'll need to use local credentials to log in to dev site
