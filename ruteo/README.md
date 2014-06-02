Ruteo dinámico en Routers CISCO
===============================

Introducción
------------

La presente practica tiene por objetivo presentar someramente la implementación de ruteo dinámico en routers de tecnología CISCO, aprovechando la funcionalidad que nos brinda la herramienta GNS3.

GNS3 es un programa de software libre que permite emular ruteadores CISCO de diversos modelos. Como condición, se necesita una imagen del Sistema Operativo CISCO que se ejecuta en el router.

En el presente proyecto se busca armar una pequeña red donde se implementen
dos protocolos de ruteo dinámico, y ver como funcionan en un contexto que emula un entorno real.

Se dispone de dos ejemplos:

* RIPv2: Implementa una topología básica que llena las tablas de rutas de los ruteadores mediante el protocolo RIPv2.
* OSPF: Implementa una topología básica con OSPF como protocolo de ruteo dinámico.

Instalación
-----------

### En Ubuntu y Debian
 
```
# apt-get install gns3
```

**NOTA: Hay un bug con el idioma, es necesario ponerlo en idioma ingles, porque en español tira error al agregar enlaces entre los ruteadores.**

Consigna
--------

Construir topologías de ejemplo en GNS3 para probar la forma de configuración y resultados de protocolos de ruteo dinámico. Los ejemplos para implementar son dos:

- RipV2
- OSPF

La estructura lógica de la red se encuentra en `topologia.png` en cada uno de los ejemplos. 

La explicación sobre el uso de Dynamips GNS3 se vera de forma rápida en clase.

¿Como crear la topología?
-------------------------

1. Crear en GNS3 la estructura de Routers propuesta en la topología. Tipo de Router: `c2600`; Tipo de enlace: `FastEthernet`.
1. Iniciar todos los dispositivos, y capturar en `FastEthernet0/0` del `R4` y la interfaz de `R1` conectada a la red `192.168.1.0/30`
1. Iniciar consola administrativa en todos los routers.
1. Presionar `[Enter]`, Responder `no` a la pregunta inicial, y esperar hasta que aparezca el prompt `Router>`
1. Ejecutar las configuraciones correspondientes en los ejemplos según corresponda.

Guardar la configuración de un Router
-------------------------------------

GNS3 no guarda el estado interno de los routers, ni las configuraciones que nosotros hagamos en ellos.
Para hacerlo de forma manual para un Router dado, hay que seguir el siguiente procedimiento:

1. Realizar las tareas deseadas en la consola del Router
1. Ejecutar el comando `#copy run start`
1. Presionar `[Enter]` en la pregunta que realiza el comando.
1. Ir a la topología en GNS3, hacer click derecho sobre el router, y seleccionar `Startup-config`
1. Presionar el botón `Cargar el archivo de configuración....` hasta que se haya cargado el `textarea` de la ventana.
1. En el input que dice `Archivo de configuración:`, colocar el Path (absoluto) al archivo de texto donde queremos que se guarde la configuración.

**NOTA: Hay que confirmar que todo se ha hecho satisfactoriamente, sino, puede que haya problemas de permisos sobre los archivos (Y no muestra errores, pero los archivos no contienen ningún comando).**

Comandos útiles
---------------

```
>enable                         (Pasa a modo administrador)
#show ip route                  (Muestra la tabla de rutas)
#show ip interface brief        (Muestra las interfaces e IPs)
#copy run start                 (VM -> file - Configuración)
#copy start run                 (file -> VM - Configuración)
```

Apuntes y Dudas
---------------

### Calculo de la wildcard

```
	255 . 255 . 255 . 255 (Mascara de red "completa")
   -
	255 . 255 . 255 . 252 (Mascara de red de la red a calcular la wildcard)
   -----------------------
     0  .  0  .  0  .  3
```

### Áreas

Al menos debe existir un área 0. Pueden o no existir sub áreas, 
principalmente para facilitar tareas de administración en Sistemas Autónomos 
grandes. Área 0 = Área Backbone o área principal.

### 224.0.0.9

224.0.0.9 es la dirección Multicast de todo router que estén ejecutando RIPv2 para un mismo segmento de red.

### Gateway of last resort is not set

Este mensaje avisa que no se encuentra seteado el default gateway en el ruteador. A modo de ejemplo, para hacerlo el comando seria:

```	
ip route 0.0.0.0 0.0.0.0 <ip_default_gateway>
```

### ip route

Cuando se ejecuta el comando `show ip route`, se muestran dos números entre
corchetes, de esta forma `[120/1]` donde:

- 120: Es la distancia administrativa que un router cisco le asigna a un ruteador por defecto con RIP.
- 1: La métrica para alcanzar esa red (Cantidad de ruteadores hasta dicha  red, por ejemplo).

GNS3 Tips
---------

### Idioma

Realizando las practicas se ha notado que usar el GNS3 en castellano hace que la aplicacion sea inestable. No se han buscado los motivos y si existen parches, pero lo recomendable es usarla en idioma ingles.

### Iniciar gran cantidad de Routers

GNS3 tiene una opcion de iniciar todos los routers de una topologia que estemos trabajando. Por defecto, esto genera una sobrecarga en la aplicacion y hay que reiniciarla para que vuelva a funcionar. 

Una solucion para no tener que iniciar los Routers de forma individual fue ir a `Edit -> Preferences -> General -> General Settings (Tab) -> Delay between each device start... (Option)` y setear dicho valor a uno mas alto. 

Las pruebas con 5 segundos fueron satisfactorias en nuestro caso.

### Paths de las imagenes de IOS

En algunos casos se comprobo que si las imagenes de SO a virtualizar estan en un path muy largo o con caracteres, las maquinas virtuales no bootean. El consejo es poner la Imagen del IOS en un path sencillo y sin caracteres extraños (Que no contengan acentos, espacios, etc...)

### Wireshark crash

Dependiendo de las versiones, a veces Wireshark se puede volver inestable. Eso hace que trabajar con las capturas se vuelva problematico (GNS se integra con wireshark).

En general, si ocurre eso tambien sucede que si ejecutamos en una terminal wireshark (Sin ser superusuario), ademas de iniciarse la interfaz, por consola vemos una salida similar a la siguiente luego de trabajar un rato:

```
(wireshark:7672): GLib-GObject-WARNING **: invalid unclassed pointer in cast to 'GtkScrollbar'

(wireshark:7672): GLib-GObject-WARNING **: invalid unclassed pointer in cast to 'GtkWidget'

(wireshark:7672): GLib-GObject-WARNING **: invalid unclassed pointer in cast to 'GObject'

(wireshark:7672): GLib-GObject-CRITICAL **: g_object_get_qdata: assertion 'G_IS_OBJECT (object)' failed

(wireshark:7672): Gtk-CRITICAL **: gtk_widget_set_name: assertion 'GTK_IS_WIDGET (widget)' failed

(wireshark:7672): GLib-GObject-WARNING **: invalid unclassed pointer in cast to 'GObject'

(wireshark:7672): GLib-GObject-CRITICAL **: g_object_set_qdata_full: assertion 'G_IS_OBJECT (object)' failed

(wireshark:7672): GLib-GObject-WARNING **: invalid unclassed pointer in cast to 'GtkRange'

(wireshark:7672): Gtk-CRITICAL **: gtk_range_get_adjustment: assertion 'GTK_IS_RANGE (range)' failed

(wireshark:7672): GLib-GObject-WARNING **: invalid unclassed pointer in cast to 'GtkOrientable'Killed
```

Para el momento que los mensajes anteriores aparecen, ya no se puede trabajar con la interfaz de Wireshark. Cerrar wireshark, y ejecutar el siguiente comando: `export LIBOVERLAY_SCROLLBAR=0`.

Luego, en la misma consola ejecutar el wireshark, y probar que luego de un tiempo no vuelven a salir los mensajes. 

Confirmado lo anterior, hay que lograr que cuando GNS3 ejecute wireshark, ademas establezca la variable de entorno.

Ir a `Edit` -> `Preferences` -> `Capture` -> `Command to launch Wireshark...` y cambiar el contenido por lo siguiente: `(export LIBOVERLAY_SCROLLBAR=0 && wireshark %c)`

Esta solución es una integración propia de lo encontrado en los siguientes hilos:
 * [AskUbuntu](http://askubuntu.com/questions/413449/ubuntu-13-10-wireshark-crashes-at-start-of-capture-with-segfault-unless-ran-as-r)
 * [StackOverflow](http://stackoverflow.com/questions/10856129/setting-an-environment-variable-before-a-command-in-bash-not-working-for-second)
 