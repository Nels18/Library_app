INSERT INTO book (author_id, category_id, title, publication_date, summary) 
VALUES (1,1,'Les Entretiens de Confucius', '2020-11-29', "Devenu quelques siècles après sa mort, et durant deux millénaires, le saint patron des lettrés, Confucius (551-479 av. J.-C.) est universellement considéré comme l'une des plus éminentes figures de la Chine dont il est désormais l'icône culturelle. Si sa vie est méconnue, il nous reste un témoignage de première importance quant à son activité de pédagogue, qui offre un portrait à la fois moral, intellectuel et affectif de l'homme : ces Entretiens, compilation des notes prises du vivant du Maître par chacun des disciples et réunies après sa mort."), 
       (2,2,'150 recettes de sauces', '2000-01-01', "Vous découvrirez que réaliser une bonne sauce n'est pas forcément synonyme de difficulté. De plus, une bonne sauce nappant un plat tout simple peut en faire une délicatesse ! De nombreux conseils pour que fonds, jus ou bouillons, bases, liaisons, à chaud ou à froid, n'aient plus de secret pour vous."), 
       (3,3,'Alex', '2012-05-02', "Qui connaît vraiment Alex ? Elle est belle. Excitante. Est-ce pour cela qu'on l'a enlevée, séquestrée et livrée à l'inimaginable ? Mais quand le commissaire Verhoeven découvre enfin sa prison, Alex a disparu. Alex, plus intelligente que son bourreau. Alex qui ne pardonne rien, qui n'oublie rien, ni personne. Un thriller glaçant qui jongle avec les codes de la folie meurtrière, une mécanique diabolique et imprévisible où l'on retrouve le talent de l'auteur de Robe de marié."),
	   (4,3,'Thérapie', '2009-11-04', "Josy, douze ans, la fille du célèbre psychiatre berlinois Viktor Larenz, est atteinte d’une maladie qu’aucun médecin ne parvient à diagnostiquer. Un jour, après que son père l’a accompagnée chez l’un de ses confrères, elle disparaît. Quatre ans ont passé. Larenz est toujours sans nouvelles de sa fille quand une inconnue frappe à sa porte. Anna Spiegel, romancière, prétend souffrir d’une forme rare de schizophrénie : les personnages de ses récits prennent vie sous ses yeux. Or, le dernier roman d’Anna a pour héroïne une fillette qui souffre d’un mal étrange et qui s’évanouit sans laisser de traces... Le psychiatre n’a dès lors plus qu’un seul but, obsessionnel : connaître la suite de son histoire.")
;
INSERT INTO author (firstname, lastname) 
VALUES
	(NULL, 'Confucius'),
	('Gérard', 'Rolleri'),
	('Pierre', 'Lemaitre'),
	('Sebastian','Fitzek');
    
INSERT INTO category (name) 
VALUES
	('Phylosophie'),
	('Cuisine'),
	('Thriller');
    
ALTER TABLE author
MODIFY  `firstname` VARCHAR(100) NULL;

SELECT b.title, a.firstname, a.lastname, c.name category, b.publication_date, b.summary  FROM book b
	JOIN author a ON a.id = b.author_id
    JOIN category c ON c.id = b.category_id
    ORDER BY id
;

INSERT INTO book (author_id, category_id, title, publication_date, summary)
VALUES ($author_id, $category_id, $title, $publication_date, $summary);

UPDATE books
	SET  title ='$title',
	authorId = '$authorId' ,
	categoryId = '$categoryId',
	publication_date='$publication_date',
	summary='$summary'
	WHERE id ='$id';
            
SELECT YEAR(publication_date) as pubDate 
FROM book 
	GROUP BY pubDate 
	ORDER BY pubDate;

SELECT b.id, b.title, a.firstname, a.lastname, c.name category, YEAR(b.publication_date) as pub_date, b.summary 
FROM book b
	INNER JOIN author a ON a.id = b.author_id
	INNER JOIN category c ON c.id = b.category_id 
	WHERE b.publication_date = 2000 
	AND b.title LIKE '%ent%' 
	OR b.title LIKE '%de%' 
	ORDER BY id;