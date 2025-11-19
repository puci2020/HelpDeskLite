## Przed uruchomieniem aplikacji:

### Backend (laravel):
Skopiuj plik `backend/.env.example` i nazwij do `backend/.env`
Plik zawiera już wygenerowany klucz i ustawione połączenie z bazą danych.

### Frontend (angular):
Nie trzeba nic robić.

(Wiem że tak się nie robi, ale dla ułatwienia w takiej aplikacji postanowiłem zostawić gotowe pliki konfiguracyjne :D)

## Uruchomienie aplikacji
### Budowanie kontenerów
W katalogu z plikiem  `docker-compose.yml` wpisz w terminalu:

``docker compose up --build -d``

Docker zainstaluje niezbędne zależności dla Angular i Laravel. Dodany jest skrypt `entrypoint.sh` który odpowiada za automatyczne uruchomienie migracji w bazie danych wraz z seederami.

### Po zbudowaniu konteneróœ
aplikacja powinna się uruchomić:

Frontend: `http://localhost:4200`

Backend: `http://localhost:8000`

## Funkcje aplikacji:
### Autoryzacja
* Laravel Sanctum
* Middleware na endpointy
* Sesja w Angular Interceptor
* AuthGuard zabezpieczający trasy

### Uprwanienia
* Spatie Permissions
* Dostęp do ticketów (TicketPolicy)

### Modul Ticketów (laravel)
* Tworzenie nowych zgłoszeń (TicketStoreRequest)
* Edycja zgłoszeń (TicketUpdateRequest)
* Usuwanie zgłoszeń
* Pobieranie listy zgłoszeń oraz pojedynczego zgłoszenia
* Filtrowanie i zarządzanie tagami przypisanymi do zgłoszeń
* Rejestrowanie zmian statusu zgłoszeń (TicketStatusChange model)

### Historia zmian
* Zdarzenie TicketStatusChanged
* Listener LogTicketStatusChange zapisujący zmiany w historii
* Model TicketStatusChange z historią zmian statusu

### Widoki (angular)
* Lista zgłoszeń (ticket-list)
* Szczegóły zgłoszenia (ticket-details)
* Edycja zgłoszenia (ticket-edit)
* Tworzenie zgłoszenia

### Triage
* Podpowiedzi AI do zgłoszenia w momencie edycji

### Layout
* nagłówek
* stopa
* menu boczne
* główny layout
* ciemny/jasny tryb