**Projekt: Portfólió weboldal hobbi projektek bemutatására**

Cél egy portfólió weboldal létrehozása a személyes hobbi projektek bemutatására, az alábbi funkcionális és technikai követelmények mentén.

---

### **Felhasználói felület (Frontend – React)**

1.  **Projektlista oldal:**
    *   A projektek megjelenítése rács vagy lista nézetben.
    *   Minden projektnél látható legyen:
        *   A projekt címe.
        *   Egy kiemelt bélyegkép (thumbnail).
        *   Rövid leírás előnézete.

2.  **Részletes projektoldal:**
    *   Minden projekthez tartozzon egy külön aloldal, amely tartalmazza:
        *   A projekt teljes címe.
        *   A teljes leírás, Markdown formázással.
        *   Egy nagy méretű fejléc/borítókép (hero/banner image).
        *   Egy link vagy gomb, amellyel a projekt élőben megtekinthető.
        *   Képgaléria a további képeknek.
        *   Egy "Letölthető fájlok" szekció, ahol a projekthez csatolt fájlok (pl. dokumentáció, forráskód archívum) listázva vannak és letölthetők.
        *   Egyértelmű navigáció vissza a projektlistára.

---

### **Adminisztrátori felület (Frontend – React)**

1.  **Bejelentkezés:**
    *   Biztonságos bejelentkezési rendszer.

2.  **Projektkezelés (CRUD műveletek):**
    *   Projektek létrehozása, szerkesztése és törlése.
    *   Projekt címének és URL-jének megadása, szerkesztése.
    *   Leírások írása és szerkesztése egy beépített Markdown szerkesztővel.
    *   Változtatások előnézetének megtekintése a közzététel előtt.

3.  **Képkezelés és Galéria:**
    *   Minden projekthez egyedi képgaléria tartozik.
    *   A galériába bármilyen méretarányú kép feltölthető.
    *   A galériából lehet kiválasztani a borítóképet.
    *   A galériában lévő képek sorrendjének egyszerű módosítása.

4.  **Fájlkezelés:**
    *   Lehetőség tetszőleges típusú fájlok feltöltésére és a projekthez való csatolására (pl. `.zip`, `.pdf`, `.txt`).
    *   A projekthez már feltöltött fájlok listázása és törlése.

---

### **Technikai követelmények és Architektúra**

1.  **Architektúra:**
    *   **Különválasztott Frontend és Backend:** A projekt API-vezérelt architektúrára épül.
    *   **API alapú kommunikáció:** A frontend és a backend közötti adatcsere RESTful API-n keresztül történik.

2.  **Technológiai Stack:**
    *   **Backend: Laravel** (PHP keretrendszer)
        *   **Felelősségi köre:** REST API végpontok biztosítása, adatbázis-kezelés, felhasználói authentikáció (pl. Laravel Sanctum), kép- és fájlkezelés. **Ide tartozik a tetszőleges fájlok feltöltésének logikája és a biztonságos letöltésüket biztosító végpontok létrehozása.**
    *   **Frontend: React** (JavaScript könyvtár)
        *   **Felelősségi köre:** A felhasználói felület (publikus és admin) felépítése, állapotkezelés, API hívások kezelése. Ez egy **Single Page Application (SPA)** lesz.
    *   **Adatbázis: SQLite**
        *   **Felelősségi köre:** A projektadatok, a képek metaadatainak, valamint **a feltöltött fájlok elérési útvonalának és nevének** tárolása.

3.  **További technikai specifikációk:**
    *   **Markdown támogatás:** A projektleírások formázásához.
    *   **Reszponzív képkezelés és optimalizáció:** A Laravel backend felel a feltöltött képek automatikus átméretezéséért.
    *   **Biztonságos authentikáció:** A Laravel biztosítja a token alapú authentikációt az admin felület védelméhez.
    *   **Kép- és fájlfeltöltés előnézettel:** A React frontend valósítja meg a feltöltés előtti vizuális visszajelzést.