# Sejm
* [Założenia projektu](#założenia-projektu)
* [Technologie](#technologie)
* [Setup](#setup)
* [Funkcje](#funkcje)
* [Problemy](#problemy)

## Założenia projektu
1. Za pomocą PHP pobrać dane z API Sejmu i nastrępnie dla każdego posła obecnej kadencji wygenerować osobną stronę z unikalnym linkiem.
2. Na stronie głównej wygenerować listę linków dla podstrony każdego posła.
3. Cały projekt ma być responsywny.
4. Za pomocą pól ACF jest możliwe edytowanie informacji o posłach
5. Ważne, by wszystko wykonywało się jak najbardziej automatycznie

## Technologie
Pobieranie danych z API odbywa się po stronie PHP. Strony dla każdego posła zostały wygenerowane za pomocą CPT. Do edycji pól został wykorzystany plugin ACF.

## Setup
Cały projekt został stworzony jako osobny motyw Sejm, wystarczy go pobrać i dodać do folderu _themes_
Ważne! Konieczne jest zainstalowanie pluginu ACF

## Funkcje
Na początku w funkcji _register_mp_cpt()_ rejestruję Custom Post Type dla posłów
![image](https://github.com/user-attachments/assets/549d804f-1e7e-412d-a99d-a962181bd1e4)
<br>
W _import_mp()_ wykonuję request do API i tworzę stronę posła. Sprawdzam też czy dane w polach ACF się zmieniły i jeżeli tak, to je aktualizuję. Dodaję też _post_meta_ z id posła. Póżniej dzięki niemu pobieram zdjęcie.
![image](https://github.com/user-attachments/assets/6d41dbd3-0a02-4283-b4d1-beab10a599d4)
<br>
Funkcja _ensure_mp_image_loaded_ wykonuje się po wejściu na podstrone posła. Na początku sprawdzam, czy dane zdjęcie jest już pobrane. Jeżeli nie, to pobieram je do Media i ustawiam jako thumbnail. Później dzięki temu wyświetlam je na podstronie.
![image](https://github.com/user-attachments/assets/49915258-2bc1-49ea-869b-f52f131099b6)
<br>
W  _votings_stats_ pobieram dodatkowe informację o pośle, zapisuję je w post_meta, później wykorzystuję je do wyświetlania na stronie.
![image](https://github.com/user-attachments/assets/5657d430-508b-4662-b5db-661baefa47c6)

## Problemy
Największym problemem była wielkość danych pobranych z API. Pobranie wszystkich posłów (aktywnych i nieaktywnych) mocno obciąża stronę. Chciałam, żeby strona była jak najbardzie automatyczna, więc za pomocą cron ustawiła, że lista posłów pobiera się raz dziennie. Był to ddla mnie ważny aspekt ponieważ lista posłów może uledz zmianie. Założyłam też, że klient nie ma dostępu do admin panel
Dużym obciążeniem jest też pobieranie zdjęć z API, rozwiązałam to pobierając każde zdjęcie osobno, przy wejściu na podstronę posła. Funkcja upewnia się, czy zdjęcie już nie istnieje w _Media_.

### Pomysł rozwiązania problemu obciążenia
Tutaj nie jestem pewna, czy byłoby to zgodne z zadaniem, ale żeby poprawić wydajność strony i user experience, ograniczyłabym ilość wyświetlanych posłów na głownej stronie do np. 15, tylko tylu pobrać z API. Pod posłami dodać Przycisk "Show more" i częściami pobierać następnych posłów. Tak samo rozwiązałabym problem obciążenia na każdej stronie posła. 
