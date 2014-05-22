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

### En Ubuntu y Debian ###
 
```
# apt-get install gns3
```

**NOTA: Hay un bug con el idioma, es necesario ponerlo en idioma ingles, porque en español tira error al agregar enlaces entre los ruteadores.**

Consigna
--------

Construir topologías de ejemplo en GNS3 para probar la forma de configuración y resultados de protocolos de ruteo dinámico. Los ejemplos para implementar son dos:

- [RipV2](README_RIPv2.md)
- [OSPF](README_OSPF.md)

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

Apuntes y Dudas
---------------

### Calculo de la wildcard ###

```
	255 . 255 . 255 . 255 (Mascara de red "completa")
   -
	255 . 255 . 255 . 252 (Mascara de red de la red a calcular la wildcard)
   -----------------------
     0  .  0  .  0  .  3
```

### Áreas ###

Al menos debe existir un área 0. Pueden o no existir sub áreas, 
principalmente para facilitar tareas de administración en Sistemas Autónomos 
grandes. Área 0 = Área Backbone o área principal.

### 224.0.0.9 ###

224.0.0.9 es la dirección Multicast de todo router que estén ejecutando RIPv2 para un mismo segmento de red.

### Gateway of last resort is not set ###

Este mensaje avisa que no se encuentra seteado el default gateway en el ruteador. A modo de ejemplo, para hacerlo el comando seria:

```	
ip route 0.0.0.0 0.0.0.0 <ip_default_gateway>
```

### ip route ###

Cuando se ejecuta el comando `show ip route`, se muestran dos números entre
corchetes, de esta forma `[120/1]` donde:

- 120: Es la distancia administrativa que un router cisco le asigna a un ruteador por defecto con RIP.
- 1: La métrica para alcanzar esa red (Cantidad de ruteadores hasta dicha  red, por ejemplo).

