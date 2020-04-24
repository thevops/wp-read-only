# wp-read-only
Make your WordPress read only

Celem wtyczki jest zabezpieczenie WordPressa.


## Funkcje
- zmiana uprawnień do plików na 0444
- zmiana uprawnień do katalogów na 0555
- przechwytywanie zapytań do bazy danych i filtracja tylko SELECT


W efekcie strona jest tylko do odczytu. Nie można zalogować się do kokpitu, używać wyszukiwarki, a także formularzy kontaktowych.
Trzeba liczyć się z tymi konsekwencjami, ale w zamian mamy stronę nie do shakowania.
Modyfikacja strony jest możliwa, po wyłaczeniu wtyczki.

## Użytkowanie
- włączenie polega na wywołaniu adresu URL: twojastrona.pl/ro-switch.php?s=on
- wyłączenie podobnie: twojastrona.pl/ro-switch.php?s=off


Zalecam zmienić nazwę pliku `ro-switch.php` na inną, najlepiej losową, trudną do odgadnięcia.


## Instalacja

1. Pobrać repozytorium do katalogu wp-content/plugins/
2. Przenieść plik `ro-switch.php` do katalogu głównego.
3. Wpisać adres do pliku `functions.php` w `ro-switch.php` -> np. `wp-content/theme/mojmotyw/functions.php`
4. Wkleić poniższy kod do pliku `functions.php` naszego motywu (najlepiej zrobić motyw potomny, chyba że nie będzie go aktualizowali) na samej górze, zaraz po załadowaniu bibliotek (include):

```
/**
 * Credits: https://wordpress.stackexchange.com/a/243441
 * Whitelist "SELECT" and "SHOW FULL COLUMNS" queries.
 */
function my_readonly_filter( $query ) {
    global $wpdb;
  
    if ( preg_match( '/^\s*select|show full columns\s+/i', $query ) ) {
      return $query;
    }
  
    // Return arbitrary query for everything else otherwise you get 'empty query' db errors.
    return "SELECT ID from $wpdb->posts LIMIT 1;";
  }
  add_filter('query', 'my_readonly_filter');
```

3. Zmienić nazwę tego pliku na inną, najlepiej losową, trudną do odgadnięcia.
