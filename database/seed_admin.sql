-- Seed an administrator account (idempotent)
INSERT INTO users (username, password, email)
VALUES
  ('admin', '$2y$12$3j4.RQc/DPS/yjkYBjkWu.ib9FHu3eIOqwNZmvwEoOpP.5LFhGaZW', 'admin@example.com')
ON DUPLICATE KEY UPDATE
  password = VALUES(password),
  email = VALUES(email);

