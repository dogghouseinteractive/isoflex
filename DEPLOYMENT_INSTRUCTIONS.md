# Deployment Instructions for isoflex.com (dev.isoflex.com)

## ✅ Setup Complete!

SSH key authentication has been configured and the deployment script is ready to use.

**Deployment Target:** dev.isoflex.com (Development Environment)
**Server:** isoflex.com (44.230.128.123)
**Theme Path:** `/home/isoflex_doghouse/web/dev.isoflex.com/public_html/wp-content/themes/isoflex/`

---

## Deploying Changes

### Standard Deployment Workflow

1. **Make your changes** in `/Users/troycono/Documents/Git Repos/isoflex.com/`
2. **Test locally** on Local by WPEngine (changes appear instantly via symlink)
3. **Commit to Git:**
   ```bash
   cd "/Users/troycono/Documents/Git Repos/isoflex.com"
   git add -A
   git commit -m "Your commit message"
   git push origin main
   ```
4. **Deploy to dev.isoflex.com:**
   ```bash
   ./deploy-to-myvesta.sh
   ```

### Quick Deploy Command

If you've already committed your changes:

```bash
cd "/Users/troycono/Documents/Git Repos/isoflex.com" && ./deploy-to-myvesta.sh
```

---

## What the Deployment Script Does

The `deploy-to-myvesta.sh` script will:
- ✅ Check for uncommitted changes and prompt you to commit
- ✅ Create the theme directory if needed
- ✅ Sync all files to dev.isoflex.com via rsync
- ✅ Exclude unnecessary files (.git, node_modules, .DS_Store, etc.)
- ✅ Show progress with colored output

---

## Manual Deployment (If Script Fails)

Use rsync directly:

```bash
rsync -avz --delete \
    --exclude='.git' \
    --exclude='.gitignore' \
    --exclude='node_modules' \
    --exclude='.DS_Store' \
    --exclude='*.sh' \
    --exclude='*.md' \
    ./ \
    isoflex_doghouse@isoflex.com:/home/isoflex_doghouse/web/dev.isoflex.com/public_html/wp-content/themes/isoflex/
```

---

## Troubleshooting

### SSH Asks for Password
If SSH suddenly asks for password again:
```bash
ssh-copy-id -i ~/.ssh/id_ed25519.pub isoflex_doghouse@isoflex.com
```
Password: `2JkJ4XGJL3N24MSK`

### Test SSH Connection
```bash
ssh isoflex_doghouse@isoflex.com "pwd"
```
Should return: `/home/isoflex_doghouse`

### View All Sites on Server
```bash
ssh isoflex_doghouse@isoflex.com "ls -la ~/web/"
```

### Permission Issues
Make sure the theme directory is writable:
```bash
ssh isoflex_doghouse@isoflex.com "chmod -R 755 ~/web/dev.isoflex.com/public_html/wp-content/themes/isoflex/"
```

---

## Important Notes

⚠️ **This deploys to DEVELOPMENT (dev.isoflex.com), not production!**
✅ Production isoflex.com is hosted elsewhere and is safe from these deployments
✅ SSH key authentication is configured - no password needed for deployments
✅ The deployment script is already tested and working
