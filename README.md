# SpotiChat

Descripción:
- Es una página responsive diseñada con Boostrap
  - Redactar desaparece en responsive y el navbar pasa a estar debajo del perfil
  - Tres páginas principales separando las tres funcionalidades con indicador de numero de eventos nuevos
  - Posibilidad de redactar Spotys (mensajes a todo el mundo) en un solo click
  - Control de no acceso a webs por link sin estar registrado
  - Posibilidad de responder a un Spoty transformandolo en un correo privado
  - Alerta de número de mensajes privados sin leer
  - Alerta de número de grupos sin leer
  - Apartado Spotys
    - Se pueden borrar solo los Spotys que has escrito tu, pero desde el perfil, no desde la portada
    - Mis mensajes aparecne con mi icono y el resto con icono random
  - En grupos estan los grupos a los que perteneces:
    - Aparece el numero de mensajes sin leer
    - Aparece un indicador de si eres nuevo en un grupo (un admin lo acabe de crear)
    - Campo para escribir un mensaje directamente al grupo
    - Al leer un grupo se vacian las notificaciones de numero de mensajes sin leer o grupo nuevo según el caso
  - En mensajes se puede responder a lo que te han escrito
    - se pueden borrar mensajes, pero le seguiran apareciendo a los demas usuarios
    - Al borrar es necesario recargar la página para ver los cambios
  - Mi perfil
    - Se muestran todos los Spotys que has redactado y los mensajes que has escrito
    - No se muestran los mensajes de los grupos
    - Los mensajes difundidos aparecen con mi icono y los demas con icono random
    - Si borras un mensaje privado te dejará de aparecer a ti pero le seguirá apareciendo al destinatario
    - En caso de borrar un Spoty, todos los usuarios dejaran de verlo (aunque no se borra de la base de datos)
    - En los difundidos no aparece asunto pero en los privados si
  - Es necesario rellenar todos los campos para enviar correos
