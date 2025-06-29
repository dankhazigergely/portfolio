### Előfeltételek

Mielőtt elkezdenéd, győződj meg róla, hogy a következő eszközök telepítve vannak a gépeden:
1.  **PHP** (8.1 vagy újabb)
2.  **Composer** (PHP csomagkezelő)
3.  **Node.js** és **npm** (vagy yarn)
4.  Egy kódszerkesztő (pl. Visual Studio Code)

---

### Lépésről lépésre útmutató

#### 1. Lépés: Projekt struktúra létrehozása

Hozzon létre egy fő mappát a projektnek, majd azon belül két külön mappát a backendnek és a frontendnek. Ez segít a tiszta szétválasztásban.

```bash
# Hozzon létre egy fő mappát és lépjen bele
mkdir portfolio-projekt
cd portfolio-projekt

# Hozzon létre mappákat a backend és frontend számára
mkdir backend
mkdir frontend
```

#### 2. Lépés: Backend beállítása (Laravel)

Először a Laravel háttérrendszert állítjuk be, ami az API-t és az adatbázis-kezelést fogja végezni.

1.  **Laravel projekt létrehozása:**
    Nyisson egy terminált a `backend` mappában (vagy navigáljon oda), és futtassa a Composer parancsot.

    ```bash
    # Lépjen a backend mappába
    cd backend
    
    # Hozzon létre egy új Laravel projektet a jelenlegi mappában
    # A pont a végén azt jelenti, hogy a `backend` mappába telepítse
    composer create-project laravel/laravel .
    ```

2.  **Adatbázis beállítása (SQLite):**
    A Laravel alapértelmezetten MySQL-t használ. Állítsuk át SQLite-ra.

    *   Hozzon létre egy üres adatbázisfájlt a `database` mappán belül:
        ```bash
        touch database/database.sqlite
        ```
    *   Nyissa meg a `.env` fájlt a `backend` mappa gyökerében, és módosítsa az adatbázis beállításokat. Keresse meg a `DB_` kezdetű sorokat, és módosítsa őket a következőre:
        ```env
        DB_CONNECTION=sqlite
        # Törölje vagy kommentezze ki a többi DB_ sort (HOST, PORT, DATABASE, USERNAME, PASSWORD)
        # DB_HOST=127.0.0.1
        # DB_PORT=3306
        # DB_DATABASE=laravel
        # DB_USERNAME=root
        # DB_PASSWORD=
        ```

3.  **Szükséges Laravel csomagok telepítése:**

    *   **Laravel Sanctum (API authentikációhoz):**
        ```bash
        composer require laravel/sanctum
        ```
        Publikálja a Sanctum konfigurációs fájlját és a migrációkat:
        ```bash
        php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
        ```

    *   **Spatie Media Library (kép- és fájlkezeléshez):** Ez a csomag tökéletes a képgalériák, borítóképek és a fájlfeltöltések kezelésére.
        ```bash
        composer require "spatie/laravel-medialibrary:^11.0"
        ```
        Publikálja a konfigurációs fájlt és a migrációt:
        ```bash
        php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="medialibrary-migrations"
        php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="medialibrary-config"
        ```

4.  **Első migráció futtatása:**
    Ez létrehozza az alapvető táblákat (felhasználók, stb.) és a telepített csomagok tábláit az SQLite adatbázisban.

    ```bash
    php artisan migrate
    ```

5.  **Backend tesztelése:**
    Indítsa el a Laravel fejlesztői szervert.
    ```bash
    php artisan serve
    ```
    Ha minden rendben van, a `http://127.0.0.1:8000` címen látnia kell a Laravel üdvözlő oldalát.

#### 3. Lépés: Frontend beállítása (React)

Most beállítjuk a React klienst, ami a felhasználói felületet fogja megjeleníteni. A **Vite** eszközt fogjuk használni, mert gyors és modern.

1.  **React projekt létrehozása Vite-tal:**
    Nyisson egy **új terminált** a projekt `frontend` mappájában.

    ```bash
    # Lépjen a frontend mappába
    cd ../frontend  # Ha a backend mappából navigál
    
    # Hozzon létre egy új React projektet a Vite segítségével a jelenlegi mappában
    npm create vite@latest . -- --template react
    ```
    A telepítő kérdéseket fog feltenni, de a fenti parancs a legtöbbet automatikusan megválaszolja (`.` a jelenlegi mappát jelöli, a `-- --template react` pedig a React sablont választja ki).

2.  **Függőségek telepítése:**
    A Vite telepítése után futtassa az `npm install` parancsot a szükséges alap csomagok letöltéséhez.
    ```bash
    npm install
    ```

3.  **Szükséges React csomagok telepítése:**

    *   **Axios (API kommunikációhoz):**
        ```bash
        npm install axios
        ```
    *   **React Router (navigációhoz, aloldalak kezeléséhez):**
        ```bash
        npm install react-router-dom
        ```
    *   **React Markdown (a Markdown leírások megjelenítéséhez):**
        ```bash
        npm install react-markdown
        ```
    *   **(Ajánlott) Tailwind CSS (gyors és modern stílusozáshoz):**
        ```bash
        npm install -D tailwindcss postcss autoprefixer
        npx tailwindcss init -p
        ```
        Ezután kövesse a Tailwind CSS és Vite integrációs útmutatóját a `tailwind.config.js` és az `index.css` beállításához.

4.  **Frontend környezeti változó beállítása:**
    Hozzon létre egy `.env` fájlt a `frontend` mappa gyökerében, és adja meg benne a backend API címét. A Vite megköveteli a `VITE_` előtagot.

    ```env
    # frontend/.env
    VITE_API_BASE_URL=http://127.0.0.1:8000
    ```
    Így az Axios hívásokban hivatkozhat erre a változóra (`import.meta.env.VITE_API_BASE_URL`), és nem kell a kódban fixen megadni az URL-t.

5.  **Frontend tesztelése:**
    Indítsa el a Vite fejlesztői szervert.
    ```bash
    npm run dev
    ```
    Ez általában a `http://localhost:5173` címen indul el. Látnia kell a React + Vite alapértelmezett kezdőoldalát.

---

### Összegzés

Ha idáig eljutott, akkor sikeresen beállította a fejlesztői környezetet:
*   Egy **Laravel backend** fut a `http://127.0.0.1:8000` címen, készen az API végpontok létrehozására.
*   Egy **React frontend** fut egy másik porton (pl. `http://localhost:5173`), készen a komponensek felépítésére.
