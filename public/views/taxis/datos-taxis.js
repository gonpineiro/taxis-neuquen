const d = document;

async function buscarConductor() {
  const patente = d.getElementById("patente").value;
  const response = await fetch("./getDatosTaxi.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ id: patente }),
  });
  const taxi = await response.json();
  console.log(taxi);
}
