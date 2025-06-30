# Útmutató fejlesztőknek (AGENTS.md) - Backend

Ez a dokumentum fontos információkat tartalmaz a backend alkalmazás fejlesztésével és tesztelésével kapcsolatban.

## Tesztelés

A projekt backend részéhez PHPUnit tesztek tartoznak, amelyek biztosítják a kód minőségét és helyes működését.

### Tesztek futtatása

A tesztek futtatásához a következő parancsot kell kiadni a `backend` könyvtárban:

```bash
php artisan test
```

Ez a parancs lefuttatja az összes unit és feature tesztet.

### Kötelező tesztfuttatás

**Minden fejlesztési feladat vagy módosítás után kötelező lefuttatni a teszteket, és biztosítani kell, hogy azok sikeresen lefussonak (`OK` státusz, 0 hibával).**

Ez segít megelőzni a regressziókat és biztosítja, hogy az új módosítások nem rontották el a meglévő funkcionalitást. Csak sikeres tesztek után szabad a kódot commit-olni és/vagy merge-ölni a fő fejlesztési ágba.

### Tesztkörnyezet

A tesztek `testing` környezetben futnak. A konfiguráció főként a `phpunit.xml` és a `.env.testing` fájlokban van meghatározva. Győződjön meg róla, hogy ezek a fájlok megfelelően vannak beállítva, különösen az `APP_KEY` és az adatbázis kapcsolat (`DB_DATABASE=:memory:`).

A nézetek fordításához használt cache elérési útja a `VIEW_COMPILED_PATH` környezeti változóval van beállítva (általában `/tmp/framework/views` vagy hasonló ideiglenes hely).

Ha problémába ütközik a tesztek futtatása során, ellenőrizze:
1. A függőségek telepítve vannak-e (`composer install`).
2. A konfigurációs cache törölve lett-e (`php artisan config:clear`).
3. Az `APP_KEY` generálva és beállítva van-e a `phpunit.xml`-ben és/vagy a `.env.testing`-ben.
4. A `.env.testing` fájl létezik és a szükséges értékeket tartalmazza.
