# TpFinal-Labo4

Pet Hero
Se requiere realizar una aplicación cuyo modelo de negocio consiste en que
personas puedan brindar el servicio del cuidado de perros. Dicho cuidado se trata de una
estadía corta a cambio de una remuneración.
Los usuarios que se registren como Keepers, tienen un perfil en el sitio donde
exponen que tipo de perro están dispuestos a cuidar (pequeño, mediano o grande) y la
remuneración esperada por la estadía.
Por otro lado, existe el tipo de usuario Owner que registra un nuevo perfil en la
aplicación y será quien contrate el servicio de los Keepers. Una vez completado el
alojamiento del perro, los Owner tienen la habilidad de generar una review sobre el servicio.
Estas reviews generarán en el Keeper una mayor reputación dentro de la aplicación.
La aplicación les permite a los usuarios Keepers, definir los días específicos que
cuentan con disponibilidad para el cuidado de perros. Esta información será de utilidad para
los Owners al momento de reservar el servicio.
Con motivo de seguridad para las mascotas, un Keeper solamente puede cuidar a
un perro por estadía.
Los Owners deberán crearle un perfil a cada perro que poseen. Por cada perfil de
mascota, deben cargar: una foto, raza, tamaño, plan de vacunación (como imagen) y
observaciones generales de la misma. La aplicación también brinda la oportunidad de subir
un video del perro.
Cuando un Owner selecciona un Keeper de su agrado, se generará una reserva en
el sistema entre las fechas que requiere. El Keeper en cuestión, deberá aceptar o rechazar
esta nueva reserva.
En caso de que la reserva sea aceptada por el Keeper, se envía un cupón de pago
al Owner con el 50% del costo del total de la estadía. Al momento de efectuar el pago, la
reserva queda confirmada.

Requisitos no funcionales:
Programación en capas de la aplicación respetando la arquitectura de 3 capas
lógicas vista durante la cursada. Esto implica el desarrollo de las clases que
representen las entidades del modelo y controladoras de los casos de uso, las vistas
y la capa de acceso a datos.

Implementación para la aprobación:
Primer revisión:
RF1 - Ingresando nuevo Owner en la aplicación.
RF2 - Ingresando nueva mascota en la aplicación.
RF3 - Consultando mi listado de mascotas (Owner).
RF4 - Ingresar nuevo Keeper.
RF5 - Un Keeper podrá indicar la disponibilidad de estadías.
RF6 - Consultar listado de Keepers cómo Owner.
Segunda revisión:
RF7 - Consultando disponibilidad de Keepers en un rango de fechas
RF8 - Generando nueva reserva desde un Owner a un Keeper
RF9 - Consultando mis reservas programadas e históricas como Keeper
RF10 - Confirmando reserva como Keeper.
Tercera revisión:
RF11 - Generando nuevo cupón de Pago para un Owner.
RF12 - Simulación de pago de cupón (confirmación de reserva).
