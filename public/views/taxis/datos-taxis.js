const d = document;

async function buscarConductor() {
  /* Reset de los datos - Transporte Público */
  d.getElementById("tipo-hab").value = "";
  d.getElementById("nro-hab").value = "";
  d.getElementById("nro-empresa").value = "";
  d.getElementById("parada").value = "";
  d.getElementById("foto_dni").src = "";

  /* Reset de los datos - Titulas Responsable */
  d.getElementById("identificacion").value = "";
  d.getElementById("nombre").value = "";

  /* Insertamos los datos - Otros Datos */
  d.getElementById("lic-comercial").value = "";
  d.getElementById("fecha-alta").value = "";
  d.getElementById("telefono").value = "";
  d.getElementById("auto-patente").value = "";
  d.getElementById("auto-marca").value = "";
  d.getElementById("auto-modelo").value = "";
  d.getElementById("fecha-hab").value = "";
  d.getElementById("vto-hab").value = "";
  // d.getElementById("fecha-utlimo-mov").value = '';
  // d.getElementById("tipo-cambio").value = '';
  d.getElementById("rto").value = "";
  d.getElementById("vto-rto").value = "";
  d.getElementById("poliza").value = "";
  d.getElementById("vto-poliza").value = "";
  d.getElementById("observacion").value = "";

  /* fetch de los datos */
  const patente = d.getElementById("patente").value;
  const response = await fetch("./getDatosTaxi.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ id: patente }),
  });

  try {
    const datosTaxi = await response.json();
    const taxi = datosTaxi.habilitacion[0];
    console.log(taxi);
    /* Mostramos la vista */
    d.getElementById("nav-tabContent").style.display = "block";
    d.getElementById("nav-tabDescription").style.display = "block";
    d.getElementById("transporte-publico").style.display = "block";
    d.getElementById("sin-datos").style.display = "none";

    /* Insertamos los datos - Transporte Público */
    if (taxi.habTipo === "TAX") taxi.habTipo = "TAXI";
    if (taxi.habTipo === "REM") taxi.habTipo = "REMIS";
    d.getElementById("tipo-hab").value = taxi.habTipo;
    d.getElementById("nro-hab").value = taxi.habNumero;
    d.getElementById("nro-empresa").value = taxi.habNumero;
    d.getElementById("parada").value = taxi.empresaNombre;
    d.getElementById("foto_dni").src = datosTaxi.imagen;

    /* Insertamos los datos - Titulas Responsable */
    d.getElementById("identificacion").value = taxi.titularEmpresa;
    d.getElementById("nombre").value = taxi.titularIdentificacion;

    /* Insertamos los datos - Otros Datos */
    d.getElementById("lic-comercial").value = taxi.licenciaComercial;
    d.getElementById("fecha-alta").value = taxi.habFechaAlta;
    d.getElementById("telefono").value = "NO HAY DATOS";
    d.getElementById("auto-patente").value = taxi.patente;
    d.getElementById("auto-marca").value = taxi.marcaVehiculo;
    d.getElementById("auto-modelo").value = taxi.modelo;
    d.getElementById("fecha-hab").value = "NO HAY DATOS";
    d.getElementById("vto-hab").value = taxi.habFechaVencimiento;
    // d.getElementById("fecha-utlimo-mov").value = "NO HAY DATOS";
    // d.getElementById("tipo-cambio").value = "NO HAY DATOS";
    d.getElementById("rto").value = taxi.rtoID;
    d.getElementById("vto-rto").value = taxi.rtoFechaVencimiento;
    d.getElementById("poliza").value = taxi.poliza;
    d.getElementById("vto-poliza").value = taxi.polizaFechaVencimiento;
    d.getElementById("observacion").value = taxi.observacion;
  } catch (error) {
    console.log(error);
    d.getElementById("nav-tabContent").style.display = "none";
    d.getElementById("nav-tabDescription").style.display = "none";
    d.getElementById("transporte-publico").style.display = "none";
    d.getElementById("sin-datos").style.display = "block";
    d.getElementById("sin-datos-descrip").textContent =
      "No se encuentra la patente: " + patente;
  }
}

function buscarDatosConductor() {
  const ind_identificacion = d.getElementById("ind_identificacion").textContent;
  const nombrec = d.getElementById("nombrec").textContent;
  const nro_conductor = d.getElementById("nro_conductor").textContent;
  const descripcion_lic = d.getElementById("descripcion_lic").textContent;
  const fecha_vencimiento_lic = d.getElementById(
    "fecha_vencimiento_licencia"
  ).textContent;
  const fecha_otorgada = d.getElementById("fecha_otorgada").textContent;
  const fecha_vencimiento = d.getElementById("fecha_vencimiento").textContent;
  const tipo_cambio = d.getElementById("tipo_cambio").textContent;
  const fecha_ultimo_cambio = d.getElementById("tipo_cambio").textContent;
  const foto_dni = d.getElementById("foto_dni").src;
  const cod_qr = d.getElementById("cod_qr").src;

  imprimirHabilitacionChofer(
    ind_identificacion,
    nombrec,
    nro_conductor,
    descripcion_lic,
    fecha_vencimiento,
    fecha_otorgada,
    tipo_cambio,
    foto_dni,
    cod_qr
  );
}
