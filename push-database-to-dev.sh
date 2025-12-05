#!/bin/bash

# Database Push Script for isoflex.com (Local -> dev.isoflex.com)
# Usage: ./push-database-to-dev.sh

# Configuration
SSH_USER="isoflex_doghouse"
SSH_HOST="isoflex.com"
LOCAL_WP_PATH="/Users/troycono/Local Sites/isoflex/app/public"
REMOTE_WP_PATH="/home/isoflex_doghouse/web/dev.isoflex.com/public_html"
TEMP_DIR="/tmp/isoflex_db_sync"

# MySQL binaries from Local by WPEngine
MYSQL_BIN="/Applications/Local.app/Contents/Resources/extraResources/lightning-services/mysql-8.0.35+4/bin/darwin/bin/mysql"
MYSQLDUMP_BIN="/Applications/Local.app/Contents/Resources/extraResources/lightning-services/mysql-8.0.35+4/bin/darwin/bin/mysqldump"

# Local Database Config
LOCAL_DB_NAME="local"
LOCAL_DB_USER="root"
LOCAL_DB_PASS="root"
LOCAL_DB_HOST="localhost"
LOCAL_DB_SOCKET="/Users/troycono/Library/Application Support/Local/run/19VyERv3h/mysql/mysqld.sock"

# Remote Database Config
REMOTE_DB_NAME="isoflex_doghouse_isoflex"
REMOTE_DB_USER="isoflex_doghouse_troy"
REMOTE_DB_PASS="ExG00yIrrp"
REMOTE_DB_HOST="localhost"

# URLs for search-replace
LOCAL_URL="https://dev.isoflex.local"
DEV_URL="https://dev.isoflex.com"

# Colors for output
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

echo -e "${YELLOW}╔═══════════════════════════════════════════════════╗${NC}"
echo -e "${YELLOW}║  Database Push: Local → dev.isoflex.com           ║${NC}"
echo -e "${YELLOW}╚═══════════════════════════════════════════════════╝${NC}"
echo ""

# Safety confirmation
echo -e "${RED}⚠️  WARNING: This will OVERWRITE the dev.isoflex.com database!${NC}"
echo -e "${YELLOW}Are you sure you want to continue? (yes/no)${NC}"
read -r response
if [[ ! "$response" =~ ^([yY][eE][sS])$ ]]; then
    echo -e "${BLUE}Database push cancelled.${NC}"
    exit 0
fi
echo ""

# Create temp directory
mkdir -p "$TEMP_DIR"

# Step 1: Export local database
echo -e "${BLUE}[1/5] Exporting local database...${NC}"
"$MYSQLDUMP_BIN" --socket="$LOCAL_DB_SOCKET" -u"$LOCAL_DB_USER" -p"$LOCAL_DB_PASS" "$LOCAL_DB_NAME" > "$TEMP_DIR/local_backup.sql"

if [ $? -ne 0 ]; then
    echo -e "${RED}Error: Failed to export local database${NC}"
    echo -e "${YELLOW}Make sure your Local site is running!${NC}"
    exit 1
fi

DB_SIZE=$(ls -lh "$TEMP_DIR/local_backup.sql" | awk '{print $5}')
echo -e "${GREEN}✓ Local database exported (${DB_SIZE})${NC}"
echo ""

# Step 2: Search and replace URLs in dump
echo -e "${BLUE}[2/5] Updating URLs for dev environment...${NC}"
sed -i '' "s|$LOCAL_URL|$DEV_URL|g" "$TEMP_DIR/local_backup.sql"
echo -e "${GREEN}✓ URLs updated: $LOCAL_URL → $DEV_URL${NC}"
echo ""

# Step 3: Backup remote database first (safety!)
echo -e "${BLUE}[3/5] Creating backup of remote database...${NC}"
BACKUP_DATE=$(date +%Y%m%d_%H%M%S)
ssh ${SSH_USER}@${SSH_HOST} "mysqldump -h'${REMOTE_DB_HOST}' -u'${REMOTE_DB_USER}' -p'${REMOTE_DB_PASS}' '${REMOTE_DB_NAME}' | gzip > ~/backups/dev_isoflex_backup_${BACKUP_DATE}.sql.gz"

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✓ Remote database backed up to: ~/backups/dev_isoflex_backup_${BACKUP_DATE}.sql.gz${NC}"
else
    echo -e "${YELLOW}⚠️  Remote backup may have failed, but continuing...${NC}"
fi
echo ""

# Step 4: Upload database dump
echo -e "${BLUE}[4/5] Uploading database to dev server...${NC}"
scp "$TEMP_DIR/local_backup.sql" ${SSH_USER}@${SSH_HOST}:/tmp/isoflex_import.sql

if [ $? -ne 0 ]; then
    echo -e "${RED}Error: Failed to upload database dump${NC}"
    exit 1
fi
echo -e "${GREEN}✓ Database uploaded to server${NC}"
echo ""

# Step 5: Import database on remote server
echo -e "${BLUE}[5/5] Importing database on dev.isoflex.com...${NC}"
ssh ${SSH_USER}@${SSH_HOST} "mysql -h'${REMOTE_DB_HOST}' -u'${REMOTE_DB_USER}' -p'${REMOTE_DB_PASS}' '${REMOTE_DB_NAME}' < /tmp/isoflex_import.sql && rm /tmp/isoflex_import.sql"

if [ $? -ne 0 ]; then
    echo -e "${RED}Error: Failed to import database${NC}"
    echo -e "${YELLOW}You can restore from backup: ~/backups/dev_isoflex_backup_${BACKUP_DATE}.sql.gz${NC}"
    exit 1
fi
echo -e "${GREEN}✓ Database imported successfully${NC}"
echo ""

# Cleanup
rm -rf "$TEMP_DIR"

# Success message
echo -e "${GREEN}╔═══════════════════════════════════════════════════╗${NC}"
echo -e "${GREEN}║  Database Push Successful! 🎉                     ║${NC}"
echo -e "${GREEN}╚═══════════════════════════════════════════════════╝${NC}"
echo ""
echo -e "${GREEN}Local database has been pushed to dev.isoflex.com${NC}"
echo -e "${YELLOW}Backup saved: ~/backups/dev_isoflex_backup_${BACKUP_DATE}.sql.gz${NC}"
echo ""
echo -e "${BLUE}Next steps:${NC}"
echo -e "  • Visit: ${DEV_URL}/wp-admin"
echo -e "  • Clear any caches if needed"
echo ""
