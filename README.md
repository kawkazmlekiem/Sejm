# Sejm
* [Założenia projektu])(#założenia-projektu)
* [Technologie](#technologie)
* [Setup](#setup)
* [Problemy](#problemy)

## Założenia projektu
1. Za pomocą PHP pobrać dane z API Sejmu i nastrępnie dla każdego posła obecnej kadencji wygenerować osobną stronę z unikalnym linkiem.
2. Na stronie głównej wygenerować listę linków dla podstrony każdego posła.
3. Cały projekt ma być responsywny.
4. Za pomocą pól ACF jest możliwe edytowanie informacji o posłach

## Technologie
Pobieranie danych z API odbywa się po stronie PHP. Strony dla każdego posła zostały wygenerowane za pomocą CPT. Do edycji pól został wykorzystany plugin ACF.

## Setup
Cały projekt został stworzony jako osobny motyw Sejm, wystarczy go pobrać i dodać do folderu _themes_
Ważne! Konieczne jest zainstalowanie pluginu ACF

## Problemy
Największym problemem była wielkość danych pobranych z API. Pobranie wszystkich posłów (aktywnych i nieaktywnych) mocno obciąża stronę. Chciałam, żeby strona była jak najbardzie automatyczna, więc za pomocą cron ustawiła, że lista posłów pobiera się raz dziennie. Był to ddla mnie ważny aspekt ponieważ lista posłów może uledz zmianie. Założyłam też, że klient nie ma dostępu do admin panel
Dużym obciążeniem jest też pobieranie zdjęć z API, rozwiązałam to pobierając każde zdjęcie osobno, przy wejściu na podstronę posła. Funkcja upewnia się, czy zdjęcie już nie istnieje w _Media_.

### Pomysł rozwiązania problemu obciążenia
Tutaj nie jestem pewna, czy byłoby to zgodne z zadaniem, ale żeby poprawić wydajność strony i user experience, ograniczyłabym ilość wyświetlanych posłów na głownej stronie do np. 15, tylko tylu pobrać z API. Pod posłami dodać Przycisk "Show more" i częściami pobierać następnych posłów. Tak samo rozwiązałabym problem obciążenia na każdej stronie posła. 
