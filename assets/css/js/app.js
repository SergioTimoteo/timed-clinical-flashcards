document.querySelectorAll('.buttons button').forEach(btn => {
  btn.onclick = () => {
    fetch(ajaxurl, {
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: new URLSearchParams({
        action: 'tcf_answer_card',
        card_id: 1,
        quality: btn.innerText === 'Fácil' ? 5 : btn.innerText === 'Bien' ? 4 : 2
      })
    })
    .then(r => r.json())
    .then(data => console.log(data));
  };
});

