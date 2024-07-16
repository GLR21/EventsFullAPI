-- Create the testing database if it doesn't exist
SELECT 'CREATE DATABASE testing'
WHERE NOT EXISTS (SELECT FROM pg_database WHERE datname = 'testing')\gexec

-- Create the testing role as a superuser if it doesn't exist
DO
$do$
BEGIN
   IF NOT EXISTS (
      SELECT FROM pg_catalog.pg_roles
      WHERE rolname = 'testing') THEN
      CREATE ROLE testing WITH LOGIN SUPERUSER PASSWORD 'your_testing_password';
   END IF;
END
$do$;

-- Grant all privileges on the testing database to the testing role
GRANT ALL PRIVILEGES ON DATABASE testing TO testing;
