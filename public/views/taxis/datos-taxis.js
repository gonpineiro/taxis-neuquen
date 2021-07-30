const d = document;

async function buscarConductor() {
  /* Reset de los datos - Transporte Público */
  d.getElementById("tipo-hab").value = "";
  d.getElementById("nro-hab").value = "";
  d.getElementById("estado-hab").value = "";
  d.getElementById("nro-empresa").value = "";
  d.getElementById("fecha-baja").value = "";
  d.getElementById("parada").value = "";
  d.getElementById("motivo").value = "";

  /* Reset de los datos - Titulas Responsable */
  d.getElementById("identificacion").value = "";
  d.getElementById("nombre").value = "";
  d.getElementById("cat-tributaria").value = "";
  d.getElementById("ident-tributaria").value = "";
  d.getElementById("cant-cotitulares").value = "";
  d.getElementById("ing-brutos").value = "";
  d.getElementById("imp-ganancias").value = "";
  d.getElementById("parada").value = "";
  d.getElementById("motivo").value = "";

  /* fetch de los datos */
  const patente = d.getElementById("patente").value;
  const response = await fetch("./getDatosTaxi.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ id: patente }),
  });

  try {
    const taxi = await response.json();
    console.log(taxi);
    /* Mostramos la vista */
    d.getElementById("nav-tabContent").style.display = "block";
    d.getElementById("nav-tabDescription").style.display = "block";
    d.getElementById("transporte-publico").style.display = "block";
    d.getElementById("sin-datos").style.display = "none";

    /* Insertamos los datos - Transporte Público */
    d.getElementById("tipo-hab").value = taxi.habTipo;
    d.getElementById("nro-hab").value = taxi.habNumero;
    d.getElementById("estado-hab").value = "NO HAY DATOS";
    d.getElementById("nro-empresa").value = taxi.habNumero;
    d.getElementById("fecha-baja").value = "NO HAY DATOS";
    d.getElementById("parada").value = "NO HAY DATOS";
    d.getElementById("motivo").value = "NO HAY DATOS";

    /* Insertamos los datos - Titulas Responsable */
    d.getElementById("identificacion").value = taxi.titularEmpresa;
    d.getElementById("nombre").value = taxi.titularIdentificacion;
    d.getElementById("cat-tributaria").value = "NO HAY DATOS";
    d.getElementById("ident-tributaria").value = "NO HAY DATOS";
    d.getElementById("cant-cotitulares").value = "NO HAY DATOS";
    d.getElementById("ing-brutos").value = "NO HAY DATOS";
    d.getElementById("imp-ganancias").value = "NO HAY DATOS";
    d.getElementById("parada").value = taxi.empresaNombre;
    d.getElementById("motivo").value = "NO HAY DATOS";

    /* Insertamos los datos - Otros Datos */
    d.getElementById("lic-comercial").value = taxi.licenciaComercial;
    d.getElementById("fecha-alta").value = taxi.habFechaAlta;
    d.getElementById("telefono").value = "NO HAY DATOS";
    d.getElementById("auto-patente").value = taxi.patente;
    d.getElementById("auto-marca").value = taxi.marcaVehiculo;
    d.getElementById("auto-modelo").value = taxi.modelo;
    d.getElementById("fecha-hab").value = "NO HAY DATOS";
    d.getElementById("vto-hab").value = taxi.habFechaVencimiento;
    d.getElementById("fecha-utlimo-mov").value = "NO HAY DATOS";
    d.getElementById("tipo-cambio").value = "NO HAY DATOS";
    d.getElementById("rto").value = taxi.rtoID;
    d.getElementById("vto-rto").value = taxi.rtoFechaVencimiento;
    d.getElementById("poliza").value = taxi.poliza;
    d.getElementById("vto-poliza").value = taxi.polizaFechaVencimiento;
    d.getElementById("observacion").value = taxi.observacion;
  } catch (error) {
    d.getElementById("nav-tabContent").style.display = "none";
    d.getElementById("nav-tabDescription").style.display = "none";
    d.getElementById("transporte-publico").style.display = "none";
    d.getElementById("sin-datos").style.display = "block";
    d.getElementById("sin-datos-descrip").textContent =
      "No se encuentra la patente: " + patente;
  }
}
