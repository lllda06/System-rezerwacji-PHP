CREATE OR REPLACE DATABASE reserwacja;
CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50),
    password VARCHAR(255),
    email VARCHAR(100)
);
CREATE TABLE slots(
    id INT AUTO_INCREMENT PRIMARY KEY,
    data DATE,
    godzina TIME,
    dostepny BOOLEAN
);
CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    slot_id INT,
    created_at DATETIME
);
ALTER TABLE reservations ADD FOREIGN KEY(user_id) REFERENCES users(id);
ALTER TABLE reservations ADD FOREIGN KEY(slot_id) REFERENCES slots(id);
INSERT INTO slots(data, godzina, dostepny) VALUES 
('2026-06-01', '10:00:00', 1),
('2026-06-01', '11:00:00', 1),
('2026-06-01', '09:00:00', 1);