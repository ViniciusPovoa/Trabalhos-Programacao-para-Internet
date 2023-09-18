function funcao(event) {
    event.preventDefault();
    const valorEmail = document.forms.cadastro["email"].value;
    const valorSenha = document.forms.cadastro["senha"].value;

    const alert = document.getElementById("alerta");
    if (valorEmail === "" || valorSenha === "") {

      const nodeH2 = document.querySelectorAll("input")
      for (let node of nodeH2)
        node.style.borderColor = "red";
      console.log("deu errado faltou email ou senha");
      alert.style.display = "block";
      return;

    }
    console.log(valorEmail);
    console.log(valorSenha);

    document.addEventListener("DOMContentLoaded", function () {

      var forms = document.getElementById("cadastro");
      forms.addEventListener("submit", funcao);
    });

  }