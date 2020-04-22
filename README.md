# zoliprojekt

1 szoba max 5fő<br>
1 ember max 5 szoba


ember{ID, nick, email, rooms}<br>
	rooms: 6x17x864x32<br>
room{ID, name, members, turn}<br>
	!a turn eggyel kezdődik<br>
	Zoli!Peti!Karcsi!Gergő<br>
amikor egy ember csinál egy szobát, akkor adj hozzá
egy szobát a rooms táblához, add bele a kreátor nickjét (az le van tárolva PHP-ben)
alapból nála lesz a turn (who paid last) 
utána pedig kérdezd le az utolsó entry ID-jét a rooms táblában és azt add hozzá
a szoba "adminjának" a listájához 
