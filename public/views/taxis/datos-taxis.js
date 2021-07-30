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

  /* Insertamos los datos */
  d.getElementById("titular-dni").textContent = taxi.titularEmpresa;
}
