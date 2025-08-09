#!/bin/bash

# Database credentials
DB_USER="root"
DB_PASS=""
DB_NAME="etmsh"

# Colors for output
GREEN='\033[0;32m'
RED='\033[0;31m'
NC='\033[0m'

# Create database
echo -e "${GREEN}Creating database...${NC}"
mysql -u $DB_USER -e "CREATE DATABASE IF NOT EXISTS $DB_NAME;"

# Import schema
echo -e "${GREEN}Importing database schema...${NC}"
mysql -u $DB_USER $DB_NAME < DATABASE\ FILE/etmsh.sql

# Backup function
backup_database() {
    BACKUP_PATH="database_backups"
    mkdir -p $BACKUP_PATH
    BACKUP_FILE="$BACKUP_PATH/etmsh_backup_$(date +%Y%m%d_%H%M%S).sql"
    
    echo -e "${GREEN}Creating backup at $BACKUP_FILE...${NC}"
    mysqldump -u $DB_USER $DB_NAME > $BACKUP_FILE
    
    if [ $? -eq 0 ]; then
        echo -e "${GREEN}Backup completed successfully${NC}"
    else
        echo -e "${RED}Backup failed${NC}"
    fi
}

# Create backup
backup_database

echo -e "${GREEN}Setup completed!${NC}" 