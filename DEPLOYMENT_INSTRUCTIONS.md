# Deployment Instructions for isoflex.com

## One-Time Setup

### Step 1: Set Up SSH Key Authentication

Open your terminal and run:

```bash
cd "/Users/troycono/Documents/Git Repos/isoflex.com"

# Copy your SSH key to the server (you'll be prompted for password once)
ssh-copy-id -i ~/.ssh/id_ed25519.pub isoflex_doghouse@isoflex.com
```

**Password when prompted:** `2JkJ4XGJL3N24MSK`

### Step 2: Test SSH Connection

After adding the key, test the connection:

```bash
ssh isoflex_doghouse@isoflex.com "pwd"
```

If this works without asking for a password, you're all set!

### Step 3: Find WordPress Path (First time only)

Once connected, find where WordPress is installed:

```bash
ssh isoflex_doghouse@isoflex.com "find ~ -type d -name 'wp-content' 2>/dev/null | head -1"
```

This will show you the path. It's probably something like:
- `/home/isoflex_doghouse/public_html/wp-content`
- or `/home/isoflex_doghouse/web/isoflex.com/public_html/wp-content`

## Deploying Changes

Once SSH is set up, deploy with:

```bash
cd "/Users/troycono/Documents/Git Repos/isoflex.com"
./deploy-to-myvesta.sh
```

## Manual Deployment (Alternative)

If the script doesn't work, you can manually deploy using rsync:

```bash
# Replace WORDPRESS_PATH with the actual path from Step 3
rsync -avz --delete \
    --exclude='.git' \
    --exclude='.gitignore' \
    --exclude='node_modules' \
    --exclude='.DS_Store' \
    --exclude='*.sh' \
    --exclude='*.md' \
    ./ \
    isoflex_doghouse@isoflex.com:/path/to/wp-content/themes/isoflex/
```

## Troubleshooting

### SSH Connection Fails
If SSH keeps asking for password:
1. Make sure you ran `ssh-copy-id` correctly
2. Check that the server allows key authentication
3. Try connecting manually: `ssh isoflex_doghouse@isoflex.com`

### Can't Find WordPress
Log into the server and look around:
```bash
ssh isoflex_doghouse@isoflex.com
ls -la
cd public_html  # or cd web
ls -la
```

### rsync Issues
Make sure rsync is installed:
```bash
which rsync
```

If not installed, you can use scp instead:
```bash
scp -r ./* isoflex_doghouse@isoflex.com:/path/to/theme/
```
