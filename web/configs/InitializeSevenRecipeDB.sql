-- Basic SQL script to initialize the Seven Recipe website database
-- Run these commands in the shell after connecting to the database with the command
--     "heroku pg:psql postgresql-corrugated-44518 --app seven-recipe"

DROP TABLE IF EXISTS recipes;

CREATE TABLE recipes(
  name VARCHAR(40),
  category VARCHAR(30) NOT NULL DEFAULT 'Other',
  description VARCHAR(100) NOT NULL DEFAULT 'No description provided',
  ingredients VARCHAR(5000) NOT NULL DEFAULT 'No ingredients given',
  instructions VARCHAR(5000) NOT NULL DEFAULT 'No instructions given',
  date_submitted TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT (NOW() AT TIME ZONE 'UTC'),
  PRIMARY KEY (name)
);

-- Insert sample data to insert (for testing)
INSERT INTO recipes (name, category, description, ingredients, instructions, date_submitted)
    VALUES ('Name', 'Category', 'Description', 'Ingredients', 'Instructions', (NOW() AT TIME ZONE 'UTC'));


