# Configurações
DB_NAME="curoblog"
DB_USER="pnogueira"
DB_PASSWORD="pnogueira"
DB_HOST="127.0.0.1"

echo "Creating PostgreSQL database..."

# Creates user and database
sudo -u postgres psql << EOF
CREATE USER $DB_USER WITH PASSWORD '$DB_PASSWORD';
CREATE DATABASE $DB_NAME WITH OWNER $DB_USER;
GRANT ALL PRIVILEGES ON DATABASE $DB_NAME TO $DB_USER;
EOF

echo "Database '$DB_NAME' created successfully!"
echo "User: $DB_USER"
echo "Password: $DB_PASSWORD"
echo "Host: $DB_HOST"