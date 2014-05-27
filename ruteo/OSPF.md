# Funcionamiento de OSPF en Routers CISCO

Pasos para el diseño y configuracion de una topologia.

## Topologia

![Topologia](http://i.imgur.com/csA8Mha.png)

## Diseño de la red

### Red 1

```
Red: 192.168.1.0/30
Netmask: 255.255.255.252
Bcast: 192.168.1.3
Wildcard: 0.0.0.3
Routers: R1, R2
Router R1
    Interface: f0/1
    IP: 192.168.1.1
Router R2
    Interface: f0/1
    IP: 192.168.1.2
```

### Red 2

```
Red: 192.168.2.0/30
Netmask: 255.255.255.252
Bcast: 192.168.2.3
Wildcard: 0.0.0.3
Routers: R1, R3
Router R1
    Interface: f0/0
    IP: 192.168.2.1
Router R3
    Interface: f0/0
    IP: 192.168.2.2
```

### Red 3

```
Red: 192.168.3.0/30
Netmask: 255.255.255.252
Bcast: 192.168.3.3
Wildcard: 0.0.0.3
Routers: R2, R3
Router R2
    Interface: f0/0
    IP: 192.168.3.1
Router R3
    Interface: f0/1
    IP: 192.168.3.2
```

### Red 4

```
Red: 192.168.4.0/30
Netmask: 255.255.255.252
Bcast: 192.168.4.3
Wildcard: 0.0.0.3
Routers: R1, R4
Router R1
    Interface: f1/0
    IP: 192.168.4.1
Router R4
    Interface: f0/0
    IP: 192.168.4.2
```

## Pasos para la configuracion

**1.** Crear en GNS3 la topologia propuesta con las siguientes especificaciones: Tipo de Router -> `c2600`; Tipo de enlace -> `FastEthernet`

**2.** Iniciar todos los dispositivos y aplicar un valor de Idle PC para mejorar el rendimiento.

**3.** Comenzar una captura en la interfaz de red de R4.

**4.** Abrir una consola en cada Router. En cada una, presionar `Enter`, Responder `no` a la pregunta inicial y esperar hasta que aparezca el prompt `Router>`.

**5.** En la consola de cada Router, ejecutar las siguientes configuraciones correspondientes para crear la topologia diseñada anteriormente:

#### Router 1

```
Router>enable
Router#configure terminal
Rotuer(config)#hostname R1
R1(config)#interface FastEthernet0/0
R1(config-if)#ip address 192.168.2.1 255.255.255.252
R1(config-if)#no shutdown
R1(config-if)#exit
R1(config)#interface FastEthernet0/1
R1(config-if)#ip address 192.168.1.1 255.255.255.252
R1(config-if)#no shutdown
R1(config-if)#exit
R1(config)#interface FastEthernet1/0
R1(config-if)#ip address 192.168.4.1 255.255.255.252
R1(config-if)#no shutdown
R1(config-if)#exit
```

#### Router 2

```
Router>enable
Router#configure terminal
Rotuer(config)#hostname R2
R2(config)#interface FastEthernet0/0
R2(config-if)#ip address 192.168.3.1 255.255.255.252
R2(config-if)#no shutdown
R2(config-if)#exit
R2(config)#interface FastEthernet0/1
R2(config-if)#ip address 192.168.1.2 255.255.255.252
R2(config-if)#no shutdown
R2(config-if)#exit
```

#### Router 3

```
Router>enable
Router#configure terminal
Rotuer(config)#hostname R3
R3(config)#interface FastEthernet0/0
R3(config-if)#ip address 192.168.2.2 255.255.255.252
R3(config-if)#no shutdown
R3(config-if)#exit
R3(config)#interface FastEthernet0/1
R3(config-if)#ip address 192.168.3.2 255.255.255.252
R3(config-if)#no shutdown
R3(config-if)#exit
```

#### Router 4

```
Router>enable
Router#configure terminal
Rotuer(config)#hostname R4
R4(config)#interface FastEthernet0/0
R4(config-if)#ip address 192.168.4.2 255.255.255.252
R4(config-if)#no shutdown
R4(config-if)#exit
```

**6.** Revisar las tablas de rutas en los routers `R2` y `R4`. Comprobar que unicamente tienen a los dispositivos adyacentes (no tiene configurado tampoco el gateway).

#### Router 2

```
R2#show ip route
Codes: C - connected, S - static, R - RIP, M - mobile, B - BGP
	   D - EIGRP, EX - EIGRP external, O - OSPF, IA - OSPF inter area 
	   N1 - OSPF NSSA external type 1, N2 - OSPF NSSA external type 2
	   E1 - OSPF external type 1, E2 - OSPF external type 2
	   i - IS-IS, su - IS-IS summary, L1 - IS-IS level-1, L2 - IS-IS level-2
	   ia - IS-IS inter area, * - candidate default, U - per-user static route
	   o - ODR, P - periodic downloaded static route

Gateway of last resort is not set

	 192.168.1.0/30 is subnetted, 1 subnets
C       192.168.1.0 is directly connected, FastEthernet0/1
	 192.168.3.0/30 is subnetted, 1 subnets
C       192.168.3.0 is directly connected, FastEthernet0/0
```

#### Router 4

```
R4#show ip route
Codes: C - connected, S - static, R - RIP, M - mobile, B - BGP
	   D - EIGRP, EX - EIGRP external, O - OSPF, IA - OSPF inter area 
	   N1 - OSPF NSSA external type 1, N2 - OSPF NSSA external type 2
	   E1 - OSPF external type 1, E2 - OSPF external type 2
	   i - IS-IS, su - IS-IS summary, L1 - IS-IS level-1, L2 - IS-IS level-2
	   ia - IS-IS inter area, * - candidate default, U - per-user static route
	   o - ODR, P - periodic downloaded static route

Gateway of last resort is not set

	 192.168.4.0/30 is subnetted, 1 subnets
C       192.168.4.0 is directly connected, FastEthernet0/0
```

**7.** Ejecutar las configuraciones provistas a continuacion para iniciar el protocolo `OSPF` en los router:

#### Router 1

```
(config)#router ospf 1
(config-router)# network 192.168.1.0 0.0.0.3 area 0
(config-router)# network 192.168.2.0 0.0.0.3 area 0
(config-router)# network 192.168.4.0 0.0.0.3 area 0
```

#### Router 2

```
(config)#router ospf 1
(config-router)# network 192.168.1.0 0.0.0.3 area 0
(config-router)# network 192.168.3.0 0.0.0.3 area 0
```

#### Router 3

```
(config)#router ospf 1
(config-router)# network 192.168.2.0 0.0.0.3 area 0
(config-router)# network 192.168.3.0 0.0.0.3 area 0
```

#### Router 4

```
(config)#router ospf 1
(config-router)# network 192.168.4.0 0.0.0.3 area 0
```

**8.** Luego de un tiempo (Esperando que el algoritmo converja), volver a consultar las tablas de rutas de los routers `R2` y `R4`. Observar las nuevas filas en la salida del comando.

#### Router 2

```
R2#show ip route
Codes: C - connected, S - static, R - RIP, M - mobile, B - BGP
	   D - EIGRP, EX - EIGRP external, O - OSPF, IA - OSPF inter area 
	   N1 - OSPF NSSA external type 1, N2 - OSPF NSSA external type 2
	   E1 - OSPF external type 1, E2 - OSPF external type 2
	   i - IS-IS, su - IS-IS summary, L1 - IS-IS level-1, L2 - IS-IS level-2
	   ia - IS-IS inter area, * - candidate default, U - per-user static route
	   o - ODR, P - periodic downloaded static route

Gateway of last resort is not set

	 192.168.4.0/30 is subnetted, 1 subnets
O       192.168.4.0 [110/2] via 192.168.1.1, 00:01:24, FastEthernet0/1
	 192.168.1.0/30 is subnetted, 1 subnets
C       192.168.1.0 is directly connected, FastEthernet0/1
	 192.168.2.0/30 is subnetted, 1 subnets
O       192.168.2.0 [110/2] via 192.168.1.1, 00:01:24, FastEthernet0/1
	 192.168.3.0/30 is subnetted, 1 subnets
C       192.168.3.0 is directly connected, FastEthernet0/0
```

#### Router 4

```
R4#show ip route
Codes: C - connected, S - static, R - RIP, M - mobile, B - BGP
	   D - EIGRP, EX - EIGRP external, O - OSPF, IA - OSPF inter area 
	   N1 - OSPF NSSA external type 1, N2 - OSPF NSSA external type 2
	   E1 - OSPF external type 1, E2 - OSPF external type 2
	   i - IS-IS, su - IS-IS summary, L1 - IS-IS level-1, L2 - IS-IS level-2
	   ia - IS-IS inter area, * - candidate default, U - per-user static route
	   o - ODR, P - periodic downloaded static route

Gateway of last resort is not set

	 192.168.4.0/30 is subnetted, 1 subnets
C       192.168.4.0 is directly connected, FastEthernet0/0
	 192.168.1.0/30 is subnetted, 1 subnets
O       192.168.1.0 [110/2] via 192.168.4.1, 00:01:53, FastEthernet0/0
	 192.168.2.0/30 is subnetted, 1 subnets
O       192.168.2.0 [110/2] via 192.168.4.1, 00:01:53, FastEthernet0/0
	 192.168.3.0/30 is subnetted, 1 subnets
O       192.168.3.0 [110/3] via 192.168.4.1, 00:01:53, FastEthernet0/0
```
