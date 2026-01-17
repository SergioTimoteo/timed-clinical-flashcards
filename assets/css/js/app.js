document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.buttons button').forEach(btn => {
    btn.onclick = () => alert('Respuesta registrada');
  });
});
