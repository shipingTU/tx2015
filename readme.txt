Installation serveur
Il est conseillé d’utiliser la même configuration serveur que le serveur de test.

Très Important : Comme nous avons choisi d’utiliser uniquement le format UTF-8 pour une meilleur compatibilité, La base de données doivent être créé en format UTF-8, et le système des fichiers doit compatible avec UTF-8 (les noms des fichiers doivent encoder en UTF-8).

Système recommandé : 
●	Linux Debien / Ubuntu 

Logiciel requis : 
●	Apache + PHP5 
○	Serveur Web
●	PostgreSql 
○	Base de données
●	Sendmail
○	Envoie de mails par PHP
●	Serveur FTP
○	Déploiement du site + upload les images / photos 
●	SSH
○	Déploiement du site

Instruction pour l’installation :

Le site complet sera fourni sous forme d’un fichier zip, ce fichier zip contient tous les codes source du site, les scriptes sql pour la création de la base de données, un fichier install.sh pour configurer les droits sur un système Linux.
1.	Décompresser le zip.
2.	Créer une base de données et un rôle dans PostgreSql
3.	Configurer la fonction connectionBD() dans le fichier fonction.php (dans le dossier ./fonction/ du projet) pour que la connexion s’adapte à la base de données créée.
4.	Exécuter le script ./BD/create.sql dans la base de données créée.
5.	Upload le dossier dans votre racine de serveur apache www/public
6.	Exécuter le script install.sh (dans la racine du projet) via une console ssh.
7.	Tester le fonctionnement du site via l’url du site à distance.
 
Configuration :
Si le site s’affiche bien, vous pouvez vous connecter par le compte administrateur par défaut (L’administrateur par défaut est déjà créé par le scripte sql) :
Login : test
Mot de passe : test
Important : pour la raison de sécurité, il est indispensable de modifier le mot de passe lors de votre première connexion.
Vous pouvez ensuite créer les autres comptes administrateur et les comptes utilisateurs internes avec ce compte (Mon compte -> inscription interne).

