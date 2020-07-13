# clickmeeting

** Uruchomienie **
1. Zainstaluj język PHP wraz z podstawowymi modułami (w tym GD).
2. Zainstaluj Symfony CLI zgodnie z instrukcjami dostępnymi [tutaj](https://symfony.com/download).
3. Przejdź do głównego katalogu aplikacji i uruchom lokalny serwer poleceniem `symfony server:start`.
4. Zobaczysz formularz uploadu plików.
5. Aby skorzystać z możliwości wysyłki plików do usług zewnętrznych, dodaj do pliku `.env` (jeśli nie istnieje - utwórz go) zmienne środowiskowe, w których zapiszesz dane konfiguracyjne do tychże usług:
```
AMAZON_BUCKET_NAME=
AMAZON_KEY=
AMAZON_SECRET=
AMAZON_REGION=
AMAZON_VERSION=
AMAZON_UPLOADS_DIRECTORY=
DROPBOX_AUTHORIZATION_TOKEN=
DROPBOX_UPLOADS_DIRECTORY=
```

** Opis **
Aplikacja oparta jest na frameworku Symfony w wersji 5.1. Składa się z prostego formularza, za którego pomocą można wykonać upload pliku obrazu na dysk lokalny komputera lub jedną z zewnętrznych usług chmurowych (Amazon S3, Dropbox). Obsługa formularza odbywa się z wykorzystaniem wzorca fabryka, który w zależności od wybranego miejsca docelowego uploadu tworzy obiekt właściwego serwisu, który zajmuje się wysyłką i zapisem pliku w docelowej lokalizacji. Serwisy dla usług zewnętrznych wykorzystują zewnętrzne biblioteki [https://flysystem.thephpleague.com/v1/docs/adapter/aws-s3-v2/](https://flysystem.thephpleague.com/v1/docs/adapter/aws-s3-v2/) oraz [https://github.com/spatie/flysystem-dropbox](https://github.com/spatie/flysystem-dropbox).