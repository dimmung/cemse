 SELECT d.nombre_rol,
    a.id_inventario_uso,
b.id_inventario,
    f.id_material,
    f.id_unidad,
b.elemento,
    c.nombre,
    a.cantidad,
    a.hora_salida,
    a.hora_llegada,
    a.geom
   FROM juego.inventario_x_uso a
     LEFT JOIN juego.inventario b ON b.id_inventario = a.id_inventario
     LEFT JOIN juego.vehiculos c ON b.id_vehiculo = c.id_vehiculo
     LEFT JOIN juego.roles_x_juego d ON d.id_rol = b.id_rol_propietario
     LEFT JOIN juego.materiales e ON b.elemento = e.id_material
     LEFT JOIN juego.unidades_inventario f ON a.id_inventario_uso = f.id_inventario_uso
     where a.id_juego = 8
     group by a.id_inventario_uso, d.nombre_rol, f.id_material,c.nombre,b.elemento,b.id_inventario,f.id_unidad
 