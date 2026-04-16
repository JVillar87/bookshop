CREATE DATABASE books_db;
USE books_db;

CREATE TABLE books
(
  id INT IDENTITY(1,1) PRIMARY KEY,
  title VARCHAR(255),
  author VARCHAR(255),
  year INT
);

INSERT INTO books
  (title, author, year)
VALUES
  ('1984', 'George Orwell', 1949),
  ('Brave New World', 'Aldous Huxley', 1932),
  ('Fahrenheit 451', 'Ray Bradbury', 1953),
  ('The Hobbit', 'J.R.R. Tolkien', 1937),
  ('Moby Dick', 'Herman Melville', 1851),
  ('Hamlet', 'William Shakespeare', 1603),
  ('The Odyssey', 'Homer', -800),
  ('Don Quixote', 'Miguel de Cervantes', 1605);