BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "pages" (
	"id"	integer,
	"date"	datetime NOT NULL,
	"title"	varchar(100) NOT NULL,
	"content"	text NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);

CREATE TABLE IF NOT EXISTS "comments" (
	"id"	integer,
	"date"	datetime NOT NULL,
	"author"	varchar(100) NOT NULL,
	"content"	text NOT NULL,
	"pages_id"	integer NOT NULL,
	CONSTRAINT "fk_comments_pages" FOREIGN KEY("id") REFERENCES "pages"("id"),
	PRIMARY KEY("id" AUTOINCREMENT)
);

INSERT INTO "pages" ("id","date","title","content") VALUES (1,'2020-08-30','Premier billet','Bonjour monde ! Ceci est le premier billet sur mon blog.'),
 (2,'2020-08-30','Au travail','Il faut enrichir ce blog dès maintenant.');
INSERT INTO "comments" ("id","date","author","content","pages_id") VALUES (1,'2020-08-30','A. Nonyme','Bravo pour ce début',1),
 (2,'2020-08-30','Moi','Merci ! Je vais continuer sur ma lancée',1);
COMMIT;
