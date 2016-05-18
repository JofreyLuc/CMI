# Call Me Ishmael

Lecteur d'ePub libres.

# Routes API

/api/users/{idUser}
- GET : retourne le profil de idUser

/api/users
- PUT : modifie le profil idUser

/api/books/{idBook}
- GET : retourne les détails de idBook

/api/books?query=...
- GET : retourne les résultats de la recherche sur query (A modifier pour nombre de résultats)

/api/users/{idUser}/library
- GET : retourne les livres de la biblio de idUser
- POST : ajoute un livre à la biblio de idUser
- PUT : Modifie le livre idLibrary dans la biblio de idUser (numéroPage, etc.)

/api/users/{idUser}/library/{idLibrary}
- GET : Recupère le livre idLibrary dans la biblio de idUser

/api/users/{idUser}/library/{idLibrary}/notes
- GET : Récupère les notes de idUser sur idLibrary
- POST : Crée une nouvelle note de idUser sur idLibrary
- PUT : Modifie la note idNote sur le livre idLibrary de idUser

/api/users/{idUser}/library/{idLibrary}/notes/{idNote}
- GET : Récupère une note (idNote) de idUser sur idLibrary
