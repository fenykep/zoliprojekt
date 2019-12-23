# zoliprojekt

1 szoba max 5fő
1 ember max 5 szoba

ember{ID, nick, email, rooms}
	rooms: 6x17x864x32
room{ID, name, members, turn}
	!a turn eggyel kezdődik
	Zoli!Peti!Karcsi!Gergő
amikor egy ember csinál egy szobát, akkor adj hozzá
egy szobát a rooms táblához, add bele a kreátor nickjét (az le van tárolva PHP-ben)
alapból nála lesz a turn (who paid last) 
utána pedig kérdezd le az utolsó entry ID-jét a rooms táblában és azt add hozzá
a szoba "adminjának" a listájához 
