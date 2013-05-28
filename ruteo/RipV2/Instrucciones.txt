Funcionamiento de RIPv2 en Routers CISCO

Uso de GNS 3 (Explicacion en clase)

Procedimiento de armado y configuracion de topologia

1) Crear en GNS3 la estructura de Routers propuesta (Archivo topologia.net) 
    Tipo de Router: c2600
    Tipo de enlace: FastEthernet

2) Iniciar todos los dispositivos, y comenzar una captura en la interfaz 
	de red de R4.

	2.1) Al iniciar los routers, aplicar en cada uno un valor de Idle PC
		para mejorar la performance del programa.

3) Abrir consola en todos los routers.

	3.1) En cada consola presionar [Enter], Responder "no" a la pregunta  
		inicial y esperar hasta que aparezca el prompt "Router>".

4) Ejecutar las configuraciones basicas detalladas en configuracion_basica.txt 
	segun corresponda para cada router.

5) Revisar las tablas de rutas en R2 y R4.

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

6) Ejecutar las configuraciones de RIP (version 2) provistas en 
	configuracion_rip_v2.txt

7) Luego de un tiempo, volver a consultar las tablas de rutas de R2 y R4.
	Comentar las diferencias.

	R2#show ip route
	Codes: C - connected, S - static, R - RIP, M - mobile, B - BGP
		   D - EIGRP, EX - EIGRP external, O - OSPF, IA - OSPF inter area 
		   N1 - OSPF NSSA external type 1, N2 - OSPF NSSA external type 2
		   E1 - OSPF external type 1, E2 - OSPF external type 2
		   i - IS-IS, su - IS-IS summary, L1 - IS-IS level-1, L2 - IS-IS level-2
		   ia - IS-IS inter area, * - candidate default, U - per-user static route
		   o - ODR, P - periodic downloaded static route

	Gateway of last resort is not set

	R    192.168.4.0/24 [120/1] via 192.168.1.1, 00:00:28, FastEthernet0/1
		 192.168.1.0/30 is subnetted, 1 subnets
	C       192.168.1.0 is directly connected, FastEthernet0/1
	R    192.168.2.0/24 [120/1] via 192.168.3.2, 00:00:23, FastEthernet0/0
						[120/1] via 192.168.1.1, 00:00:28, FastEthernet0/1
		 192.168.3.0/30 is subnetted, 1 subnets
	C       192.168.3.0 is directly connected, FastEthernet0/0
	
	
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
	R    192.168.1.0/24 [120/1] via 192.168.4.1, 00:00:18, FastEthernet0/0
	R    192.168.2.0/24 [120/1] via 192.168.4.1, 00:00:18, FastEthernet0/0
	R    192.168.3.0/24 [120/2] via 192.168.4.1, 00:00:18, FastEthernet0/0
