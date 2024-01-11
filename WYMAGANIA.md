Oceniający projekt będzie wykonywał kolejne kroki zgodnie z podanymi niżej i przyznawał punkty za wszystkie spełnione kryteria. Łączna liczba punktów możliwych do zdobycia przekracza maksymalną liczbę punktów, ponieważ nie wszystkie elementy są obowiązkowe. W ostatecznym rozliczeniu przedmiotu punkty ponad maksimum nie będą brane pod uwagę.

13 p.Podział na strefę dla użytkowników i niezalogownych
Strona musi zawierać podstrony dla użytkowników zalogowanych i dla niezalogowanych. Podział musi być zgodny z tematyką strony.

Uruchomienie strony i weryfikacja widocznej nawigacji
Oceniający spisuje dostępne linki, by porównać je później z listą dostępnych linków po zalogowaniu.

1 p.Wejście w każdy z dostępnych linków i weryfikacja dostępu
Oceniający sprawdza, czy ma dostęp do wszystkich linków wyświetlonych dla niezalogowanych. Punkty przyznaje się, gdy dostęp jest do wszystkich dostępnych stron.

6 p.Rejestracja użytkownika testowego
1 p.Odnalezienie odnośnika do podstrony z rejestracją.
Oceniający znajduje odnośnik do rejestracji użytkowników i wchodzi na odpowiednią podstronę. W przypadku braku odnośnika nie wykonuje się kolejnych punktów.

3 p.Wypełnienie formularza rejestracyjnego
Oceniający wypełnia formularz rejestracyjny zgodnie z instrukcjami dostępnymi na stronie i zatwierdza go. Punkty przyznaje się, gdy formularz rejestracji działa poprawnie, gdy instrukcje do jego wypełnienia są wystarczające do poprawnej rejestracji oraz za poprawny komunikat o pomyślnej rejestracji.

2 p.Zalogowanie użytkownika
Logowanie przez rejestrację
Jeżeli rejestracja użytkownika automatycznie go loguje, przyznaje się maksimum punktów w kolejnych kategoriach bez ich weryfikacji.

1 p.Odnalezienie odnośnika do logowania
Oceniający znajduje odnośnik do podstrony z formularzem logowania. Zamiast podstrony formularz może być bezpośrednio na stronie.

1 p.Wypełnienie formularza logowania
Oceniający wypełnia danymi logowania podanymi wcześniej w formularzu rejestracyjnym. Punkty przyznaje się za poprawne jego działanie.

Ponowna weryfikacja dostępnych odnośników
Oceniający ponownie przegląda wszystkie dostępne odnośniki. Punkty przyznaje się, gdy widoczne są nowe, niewidoczne dla niezalogowanych użytkowników. Dodatkowy punkt przyznaje się, gdy nie jest dostępny odnośnik do rejestracji i logowania, a za to dostępny jest odnośnik do wylogowania.

1 p.Weryfikacja dostępu do nowych podstron
Oceniający wchodzi we wszystkie nowe podstrony i ocenia, czy ma do nich dostęp. Dopuszcza się brak dostępu do niektórych z nich ze względu na poziom uprawnień. Przynajmniej jeden z nowych odnośników musi być dostępny.

5 p.Ocena kodu zabezpieczeń dostępu
Jeżeli poprzednie punkty nie wykazały różnicy w dostępie, tego punktu nie wykonuje się.

1 p.Odnalezienie kodu blokującego dostęp dla niezalogowanych
Oceniający znajduje w kodzie źródłowym fragmenty odpowiedzialne za blokowanie dostępu dla niezalogowanych.

2 p.Kod blokuje wykonywanie dalszych skryptów
Oceniający sprawdza, czy zastosowane zabezpieczenie na pewno blokuje wykonywanie kodu.

2 p.Kod blokujący dostęp zalogowanym lub użytkownikom bez wymaganych uprawnień
Jeżeli któraś z podstron blokuje dostęp zalogowanym użytkownikom (np. rejestracja) lub zastosowany jest system uprawnień blokujący dostęp do podstrony, przyznaje się punkty dodatkowe.

Wylogowanie użytkownika
Oceniający wylogowuje użytkownika przed kolejnym krokiem.

23 p.System użytkowników
Strona musi posiadać moduł autoryzacji. Użytkownik musi mieć możliwość zarejestrowania się, zalogowania i wylogowania. Za inne opcje przyznaje się punkty dodatkowe.

9 p.Formularz rejestracyjny
Oceniający odnajduje ponownie formularz rejestracyjny.

2 p.Badanie poprawności logiki formularza
Oceniający weryfikuje logikę formularza rejestracyjnego. Np. czy formularz dopuszcza pustą nazwę użytkownika lub puste hasło, czy weryfikuje zgodność haseł itd. Kryteria dobierane są do konkretnego formularza.

2 p.Badanie poprawności walidacji
Oceniający weryfikuje, czy podanie błędnych wartości, zgodnie z instrukcjami w formularzu, nie dopuszcza rejestracji. Punkty przyznaje się przy poprawności działania mechanizmu. Dodatkowy punkt przyznaje się, gdy wyświetlone zostaną komunikaty o błędach. Punktów nie przyznaje się, gdy żadne z pól nie wymaga walidacji lub gdy walidacja jest tylko po stronie frontowej.

5 p.Badanie kodu formularza
Oceniający weryfikuje kod obsługujący mechanikę formularza. W szczególności ocenia dobre praktyki zastosowane przy walidacji i czyszczeniu danych, przy wstawianiu ich do bazy danych oraz sposób obsługi błędów.

Poprawność konstrukcji bazy danych
Oceniający weryfikuje, czy konstrukcja tabeli w bazie danych jak i format przechowywania danych są poprawne. Przy błędach krytycznych jak niehashowanie hasła zeruje się punkty za cały punkt systemu użytkowników i nie weryfikuje się dalszych etapów.

4 p.Formularz logowania
Oceniający odnajduje ponownie formularz logowania.

1 p.Próba zalogowania bez hasła lub z niepoprawnym hasłem
Oceniający weryfikuje, czy logowanie bez hasła lub hasłem niepoprawnym jest możliwe. Punkty przyznaje się, gdy nie jest.

1 p.Próba zalogowania z pustym lub niepoprawnym loginem
Oceniający weryfikuje, czy logowanie z pustym lub niepoprawnym loginem jest możliwe. Punkty przyznaje się, gdy nie jest.

Logowanie poprawnymi danymi
Oceniający loguje się poprawnymi danymi. Punkty za to zostały przyznane we wcześniejszej fazie testów.

2 p.Ocena kodu
Oceniający ocenia dobre praktyki zastosowane w kodzie logowania. Punkty przyznaje się za bezpieczne przechowywanie danych o zalogowanym użytkowniku oraz bezpieczną weryfikację danych autoryzacyjnych. W przypadku krytycznych błędów bezpieczeństwa modułu autoryzacji nie przyznaje się punktów za cały punkt systemu użytkowników.

2 p.Wylogowanie użytkownika
Oceniający podejmuje próbę wylogowania użytkownika. Punkty przyznaje się, gdy wylogowanie jest możliwe. Dodatkowy punkt przyznaje się za komunikat o wylogowaniu albo przekierowanie na stronę główną.

2 p.* Formularz zmiany hasła
Oceniający odnajduje formularz zmiany hasła.

1 p.Próba zmiany hasła niepoprawnymi danymi
Oceniający próbuje zmienić hasło podając błędne dane. Punkty przyznaje się przy niepowodzeniu

1 p.Próba zmiany hasła poprawnymi danymi
Oceniający próbuje zmienić hasło podając poprawne dane.

3 p.* Formularz przypomnienia hasła
Oceniający podejmuje próbę przypomnienia hasła użytkownika.

Próba przypomnienia hasła
Oceniający odnajduje opcję przypomnienia hasła dla niezalogowanego użytkownika.

1 p.Otrzymanie maila
Oceniający sprawdza, czy otrzymał wiadomość mailową z danymi do przypomnienia hasła

2 p.Zmiana hasła na nowe
Oceniający przy pomocy otrzymanych danych zmienia hasło na nowe.

3 p.* Mailowe potwierdzenie rejestracji
Oceniający weryfikuje, czy do rejestracji konieczne jest potwierdzenie poprzez link wysłany mailowo.

1 p.Mail potwierdzający rejestrację
Oceniający sprawdza, czy otrzymał na maila potwierdzenie rejestracji na stronie.

2 p.Aktywacja konta
Oceniający aktywuje konto zgodnie z instrukcjami podanymi w mailu.

9 p.Interakcja ze stroną
Oceniający odnajduje wszystkie formularze pozwalające przesyłać dane. Poniższe kroki wykonuje dla każdego z dostępnych formularzy. Ocenę danego kryterium stosuje się dla każdego kwalifikującego się pola. Kroków tych nie wykonuje się dla formularzy z poprzedniego punktu.

1 p.Pola tekstowe, numeryczne, jednokrotnego wyboru itd.
Oceniający wypełnia pola przekazujące jedną wartość w postaci tekstowej. Weryfikuje, czy przesłanie poprawnych danych wpisuje je do bazy danych.

1 p.Pola wymagane
Oceniający weryfikuje, czy formularz faktycznie wymaga pól oznaczonych jako wymagane. Weryfikacja ta jest zarówno w interakcji z aplikacją jak w i kodzie źródłowym. Punkty przyznaje się za mechanizmy walidujące. Nie przyznaje się, gdy walidacja jest na poziomie bazy danych.

2 p.Pola walidowane
Oceniający sprawdza, czy pola o narzuconej treści walidują tę treść. Sprawdzane są m. in. pola numeryczne, pola mailowe itd. Punkty przyznaje się, gdy aplikacja odmawia wstawienia danych do bazy, gdy nie są w podanym formacie lub gdy dane są czyszczone aby pasowały do wskazanego schematu (o ile to możliwe).

5 p.Bezpieczeństwo przesyłania danych
Jeżeli formularze dopuszczają krytyczne błędy bezpieczeństwa jak SQL Injection, nie przyznaje się punktów za interakcję ze stroną. Przyznaje się dodatkowe punkty za dodatkowe zabezpieczenia (np. CSRF Token).

16 p.Wyświetlanie treści z bazy danych
Oceniający sprawdza poniższe możliwości wyświetlania danych z bazy danych. Jeżeli treści są statyczne, tj. nie są pobierane z bazy danych, nie przyznaje się punktów za dane kryterium.

4 p.Nawigacja
Oceniający weryfikuje, czy nawigacja na stronie generuje się na podstawie wpisów z bazy danych. Przyznaje się dodatkowe punkty, gdy nawigacja ma strukturę hierarchiczną.

6 p.Podstrona z zestawieniem danych
Oceniający znajduje podstronę z wylistowanymi danymi z bazy w jakiejkolwiek formie (np. tabela z danymi, strona z aktualnościami, cennik). Przyznaje się punkty dodatkowe, gdy dane są opracowywane, np. są modyfikowane przed wyświetleniem w celach estatycznych, dokonywane są operacje na danych liczbowych itd. Kolejne dodatkowe punkty przyznaje się, gdy zabezpieczamy wyświetlanie danych przed wyświetleniem kodu HTML wstawionego do bazy.

6 p.Profil użytkownika
Oceniający znajduje podstronę z aktualnymi danymi o koncie użytkownika. Dane mogą być wyświetlane zarówno w formularzu jak i bez formularza. Dodatkowe punkty przyznaje się za możliwość edycji danych i zabezpieczenie dostępu przez innych użytkowników (jakkolwiek rozumianego).

30 p.* Elementy dodatkowe
Zależnie od specyfiki projektu, można dodać różne dodatkowe funkcjonalności. Poniżej wymienione są przykładowe możliwości, za które przyznaje się punkty. Żadna z wymienionych funkcjonalności nie jest konieczna.

5 p.Odpowiedź zwrotna w postaci innego pliku niż HTML
Jeżeli któraś z podstron lub odpowiedź z przesłania formularza jest zwracana jako inny niż standardowy plik, np. CSV, JSON, obraz, pdf oraz plik ten jest renderowany przez PHP bez zapisywania go na serwerze, oceniający przyznaje punkty w zależności od złożoności. Punktów nie przyznaje się, gdy funkcjonalność nie ma sensu w projekcie.

3 p.Przyjmowanie plików od użytkownika
Oceniający weryfikuje, czy któryś z formularzy umożliwia przesłanie pliku na serwer. Plik musi zostać zapisany na serwerze w odpowiednim folderze na tego typu pliki. Punktów nie przyznaje się, gdy przesyłanie plików powoduje krytyczne błędy bezpieczeństwa, np. wykonanie przesłanego pliku php. Dodatkowe punkty przyznaje się za zabezpieczenia na poziomie konfiguracji serwera Apache.

3 p.Powiadomienia mailowe
Oceniający weryfikuje, czy przesłanie któregokolwiek formularza powoduje wysłanie maila potwierdzającego. Punkty przyznaje się, gdy w mailu potwierdzającym znajdują się dane przekazane w formularzu.

19 p.Konfiguracja serwera Apache
Oceniający weryfikuje różne aspekty serwera Apache, wymienione niżej.

5 p.Routing
Oceniający przyznaje punkty, gdy serwer Apache pozwala zaimplementować routing. Dopuszcza się zarówno routing na sztywno wpisany w konfigurację serwera, w pliki .htaccess jak i przekierowanie do routingu wykonanego w PHP.

1 p.HTTPS
Oceniający przyznaje punkty za wymuszenie przekierowania na HTTPS.

3 p.Zabezpieczenie folderów statycznych
Oceniający przyznaje punkty, gdy Apache zabezpiecza przynajmniej jeden podfolder przed wykonywaniem w nim skryptów PHP.

10 p.Punkty uznaniowe
Oceniający może przyznać punkty za niewymienione aspekty strony.