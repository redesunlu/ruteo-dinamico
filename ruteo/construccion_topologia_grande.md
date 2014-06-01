= Construccion de la topologia

La idea de este documento es mostrar como construir una topologia que involucre 15 routers y diferentes redes, hacer que estos conozcan la topologia de la red mediante la implementacion de ruteos dinamicos, y probar algunos cambios de topologia *al vuelo* para ver como los protocolos de ruteo dinamico reconfiguran las tablas de rutas para que la red continue funcionando.

== Redes

Por simplicidad, todos los enlaces seran FastEthernet. 

=== 192.168.0.0/29

==== Definicion de la red

Red: 192.168.0.0
Broadcast: 192.168.0.7
Hosts: 192.168.0.[1..6]  (6 hosts)
Mascara: 255.255.255.248

==== IPs

* 192.168.0.1
* 192.168.0.2
* 192.168.0.3
* 192.168.0.4

=== 192.168.0.8/29

==== Definicion de la red

Red: 192.168.0.8
Broadcast: 192.168.0.15
Hosts: 192.168.0.[9..14]  (6 hosts)
Mascara: 255.255.255.248

==== IPs

* 192.168.0.1
* 192.168.0.2
* 192.168.0.3
* 192.168.0.4
