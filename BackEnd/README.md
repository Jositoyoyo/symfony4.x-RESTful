
Symfony 4.x web clasica - En desarrollo !!!
=============

INSTALACION :
-------------------------------------------------------------------------
Clonar repositorio desde git
	git clone https://github.com/Jositoyoyo/symfony4.x.git

Instalar dependencias del proyecto
	cd symfony4.x
	composer install

Configurar en el archivo .env la linea que pone
	 DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
	 debes poner tu configuracion de la base de datos, por ejemplo :
	 DATABASE_URL=mysql://pepeAdmin:12334@127.0.0.1:3306/example

Crear base de datos partiendo de los datos contenida en las entidades
	php bin/console doctrine:database:create
	php bin/console doctrine:schema:create 

Para comprobar que la base de datos esta correctamente mapeada
	php bin/console doctrine:schema:validate

Correr el proyecto
	php bin/console server:run
---------------------------------------------------------------------------
FRONTEND DEL PROYECTO
Clonar repositorio desde git
	git clone https://github.com/Jositoyoyo/template

Instalar dependencias
	cd template
	npm install
---------------------------------------------------------------------------
Editores recomendados :
	PhpStrorm (de Pago)
	Netbeans (gratis)
Lo demas es cosa tuya ;)


------------------------------------------
 php bin/console doctrine:mapping:convert annotation --from-database src/Entity
