INSERT INTO fases (id, descripcion)
VALUES (1, 'Fase Previa'),
	   (2, 'Proceso'),
	   (3, 'Fase de Pruebas'),
	   (4, 'Finalizacion');

INSERT INTO etapas (id, descripcion, fase_id)
VALUES (1, 'Cuestionario de parte de los abogados', 1),
	   (2, 'Introduccion del libelo', 2),
	   (3, 'Copia de providencia', 2),
	   (4, 'Mandato de aceptacion', 2),
	   (5, 'Decreto de aceptacion de la demanda', 2),
	   (6, 'Citacion oficial de las partes', 2),
	   (7, 'Notificacion a la parte demandada', 2),
	   (8, 'Decreto de formula de dudas', 2),
	   (9, 'Citacion de la parte actora y demandada', 2),
	   (10, 'Citacion de testigos', 3),
	   (11, 'Decreto de admision de pruebas', 3),
	   (12, 'Decreto de pericias psiquicas o medicas', 3),
	   (13, 'Decreto de publicacion de las actas', 4),
	   (14, 'Modelo adjunto de informe que el perito debe entregar', 4),
	   (15, 'Decreto del abogado de la parte (Alegatos)', 4),
	   (16, 'Decreto de parte del defensor del vinculo (Animadversiones)', 4),
	   (17, 'Decreto de conclusion de las causas antes de la discusion de los jueces', 4),
	   (18, 'Decreto de audiencia de los jueces del tribunal', 4),
	   (19, 'Decreto de la aceptacion de sentencias definitivas de votos de juez', 4),
	   (20, 'Decreto de envio hacia una 2da instancia en caso que haya sentencia', 4),
	   (21, 'Notificacion de la sentencia', 4);