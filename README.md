⸻
 
📅 System rezerwacji konsultacji online
Prosta aplikacja webowa napisana w PHP (mysqli – styl proceduralny) oraz MySQL, umożliwiająca rezerwację terminów konsultacji.
 
⸻
 
🚀 Funkcjonalności
👤 Użytkownik
rejestracja (hasło min. 14 znaków + cyfra)
logowanie (sesje)
przegląd dostępnych terminów
rezerwacja terminu
podgląd własnych rezerwacji
anulowanie rezerwacji
👑 Administrator
dostęp do panelu admina
dodawanie nowych terminów
 
⸻
 
🔒 Bezpieczeństwo
prepared statements (mysqli)
password_hash() / password_verify()
htmlspecialchars()
sesje użytkowników
 
⸻
 
📊 Baza danych
Projekt wykorzystuje 3 tabele:
users
  id
  login
  password
  email
  is_admin
slots
  id
  data
  godzina
  dostepny
reservations
  id
  user_id
  slot_id
  created_at
 
⸻
 
⚠️ Ograniczenia
maksymalnie 3 rezerwacje na użytkownika
brak możliwości rezerwacji zajętego terminu
 
⸻
 
🛠️ Technologie
PHP (mysqli – proceduralny)
MySQL
HTML (formularze)
 
⸻
 
▶️ Uruchomienie
Utwórz bazę danych:
CREATE DATABASE rezerwacje;
Wykonaj:
USE rezerwacje;
Utwórz tabele:
CREATE TABLE users (
 id INT AUTO_INCREMENT PRIMARY KEY,
 login VARCHAR(50),
 password VARCHAR(255),
 email VARCHAR(100),
 is_admin INT DEFAULT 0
);

CREATE TABLE slots (
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
Dodaj dane testowe:
INSERT INTO slots (data,godzina,dostepny) VALUES
('2026-06-01','10:00:00',1),
('2026-06-01','11:00:00',1),
('2026-06-02','09:00:00',1);
Ustaw admina:
UPDATE users SET is_admin=1 WHERE id=1;
Skonfiguruj db.php (login/hasło do MySQL)
Uruchom projekt (np. XAMPP / localhost)
 
⸻
 
🎓 Cel projektu
Projekt wykonany jako zadanie szkolne (technikum – programista). Pokazuje podstawy:
pracy z bazą danych
autoryzacji użytkowników
bezpieczeństwa aplikacji webowych
 
⸻
 
📌 Autor
Lada Bahdanovich
 
⸻
