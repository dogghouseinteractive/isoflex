#!/bin/bash

# Setup SSH key for isoflex.com MyVesta hosting
# This script will copy your SSH public key to the server

echo "Setting up SSH key for isoflex.com..."
echo ""
echo "Your SSH public key:"
cat ~/.ssh/id_ed25519.pub
echo ""
echo "Copying SSH key to server (you'll be prompted for password)..."
echo ""

# Copy SSH key to server
ssh-copy-id -i ~/.ssh/id_ed25519.pub isoflex_doghouse@isoflex.com

echo ""
echo "Testing connection..."
ssh isoflex_doghouse@isoflex.com "pwd && echo 'SSH key setup successful!'"
