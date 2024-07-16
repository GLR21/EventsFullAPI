-- Create the events database if it doesn't exist
SELECT 'CREATE DATABASE events'
WHERE NOT EXISTS (SELECT FROM pg_database WHERE datname = 'events')\gexec

-- Create the events role as a superuser if it doesn't exist
DO
$do$
BEGIN
   IF NOT EXISTS (
      SELECT FROM pg_catalog.pg_roles
      WHERE rolname = 'events') THEN
      CREATE ROLE events WITH LOGIN SUPERUSER PASSWORD 'events';
   END IF;
END
$do$;

-- Grant all privileges on the events database to the events role
GRANT ALL PRIVILEGES ON DATABASE events TO events;
