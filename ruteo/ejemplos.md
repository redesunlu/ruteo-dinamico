Ejemplos
========

En este documento se mostraran ejemplos de la configuracion de una topologia de 4 routers, y los comandos para configurar algunos protocolos de ruteo dinamico.

## Topologia ##

Se propone la siguiente topologia para los ejemplos:

![Topologia](http://i.imgur.com/csA8Mha.png)


##   Parametros de red   ##

### Red 1 ###
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
### Red 2 ###
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
### Red 3 ###
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
### Red 4 ###
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

##   Configuracion Basica   ##

### Router 1 ###

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

### Router 2 ###

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

### Router 3 ###

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

### Router 4 ###

```
Router>enable
Router#configure terminal
Rotuer(config)#hostname R4
R4(config)#interface FastEthernet0/0
R4(config-if)#ip address 192.168.4.2 255.255.255.252
R4(config-if)#no shutdown
R4(config-if)#exit
```

##   Configuracion de ruteo  ##

### RIPv1 ###

#### Router 1 ####

```
(config)#router rip
(config-router)# network 192.168.1.0
(config-router)# network 192.168.2.0
(config-router)# network 192.168.4.0
```

#### Router 2 ####

```
(config)#router rip
(config-router)# network 192.168.1.0
(config-router)# network 192.168.3.0
```

#### Router 3 ####

```
(config)#router rip
(config-router)# network 192.168.2.0
(config-router)# network 192.168.3.0
```

#### Router 4 ####

```
(config)#router rip
(config-router)# network 192.168.4.0
```

### RIPv2 ###

#### Router 1 ####

```
(config)#router rip
(config-router)# version 2
(config-router)# network 192.168.1.0
(config-router)# network 192.168.2.0
(config-router)# network 192.168.4.0
```

#### Router 2 ####

```
(config)#router rip
(config-router)# version 2
(config-router)# network 192.168.1.0
(config-router)# network 192.168.3.0
```

#### Router 3 ####

```
(config)#router rip
(config-router)# version 2
(config-router)# network 192.168.2.0
(config-router)# network 192.168.3.0
```

#### Router 4 ####

```
(config)#router rip
(config-router)# version 2
(config-router)# network 192.168.4.0
```

### OSPF ###

#### Router 1 ####

```
(config)#router ospf 1
(config-router)# network 192.168.1.0 0.0.0.3 area 0
(config-router)# network 192.168.2.0 0.0.0.3 area 0
(config-router)# network 192.168.4.0 0.0.0.3 area 0
```

#### Router 2 ####

```
(config)#router ospf 1
(config-router)# network 192.168.1.0 0.0.0.3 area 0
(config-router)# network 192.168.3.0 0.0.0.3 area 0
```

#### Router 3 ####

```
(config)#router ospf 1
(config-router)# network 192.168.2.0 0.0.0.3 area 0
(config-router)# network 192.168.3.0 0.0.0.3 area 0
```

#### Router 4 ####

```
(config)#router ospf 1
(config-router)# network 192.168.4.0 0.0.0.3 area 0
```
