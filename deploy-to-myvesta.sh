#!/bin/bash

# Deployment script for isoflex.com on MyVesta hosting
# Usage: ./deploy-to-myvesta.sh

# Configuration
SSH_USER="isoflex_doghouse"
SSH_HOST="isoflex.com"
LOCAL_PATH="/Users/troycono/Documents/Git Repos/isoflex.com/"
THEME_PATH="/home/isoflex_doghouse/web/dev.isoflex.com/public_html/wp-content/themes/isoflex/"

# Colors for output
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

echo -e "${YELLOW}Starting deployment to MyVesta...${NC}"
echo ""

# Check if we're in the right directory
cd "$LOCAL_PATH" || exit 1

if [ ! -f "style.css" ]; then
    echo -e "${RED}Error: Not in the isoflex.com theme directory${NC}"
    exit 1
fi

echo -e "${GREEN}Deploying to: ${THEME_PATH}${NC}"
echo ""

# Commit check
if [[ -n $(git status -s) ]]; then
    echo -e "${YELLOW}Warning: You have uncommitted changes!${NC}"
    echo "Would you like to commit them first? (y/n)"
    read -r response
    if [[ "$response" =~ ^([yY][eE][sS]|[yY])$ ]]; then
        git add -A
        echo "Enter commit message:"
        read -r commit_msg
        git commit -m "$commit_msg"
        git push origin main
        echo ""
    fi
fi

# Create theme directory if it doesn't exist
echo -e "${YELLOW}Ensuring theme directory exists...${NC}"
ssh ${SSH_USER}@${SSH_HOST} "mkdir -p ${THEME_PATH}"

# Deploy using rsync
echo -e "${YELLOW}Syncing files to server...${NC}"
rsync -avz --progress --delete \
    --exclude='.git' \
    --exclude='.gitignore' \
    --exclude='node_modules' \
    --exclude='.DS_Store' \
    --exclude='*.sh' \
    --exclude='deploy-to-myvesta.sh' \
    --exclude='setup-ssh-key.sh' \
    ./ \
    ${SSH_USER}@${SSH_HOST}:${THEME_PATH}

if [ $? -eq 0 ]; then
    echo ""
    echo -e "${GREEN}╔═══════════════════════════════════════╗${NC}"
    echo -e "${GREEN}║   Deployment Successful! 🚀           ║${NC}"
    echo -e "${GREEN}╚═══════════════════════════════════════╝${NC}"
    echo -e "${GREEN}isoflex.com theme deployed to MyVesta${NC}"
    echo ""
else
    echo ""
    echo -e "${RED}Deployment failed!${NC}"
    exit 1
fi
