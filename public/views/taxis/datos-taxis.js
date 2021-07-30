const d = document;

async function buscarConductor() {
  /* Reset de los datos */
  d.getElementById("titular-dni").textContent = "";

  /* fetch de los datos */
  const patente = d.getElementById("patente").value;
  const response = await fetch("./getDatosTaxi.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ id: patente }),
  });
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
}
