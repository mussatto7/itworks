{% extends 'partials/template.twig.php' %}

{%block title%} JOB APPLICATION | Cadastro de Currículo {% endblock %}

{% block body %}
<div class="row">
  <div class="col-6">
    <form action="/formulario-salvar" method="post">
      <div class="mb-3">
        <label for="firstname" class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" id="firstname" aria-describedby="firstnameHelp">
        <p id="firstnameHelp" class="form-text">Informe apena o seu primeiro nome</p>
      </div>
      <button type="submit" class="btn btn-primary">ENVIAR FORMULÁRIO</button>
    </form>
  </div>
  <div class="col-6">
    <p>BRASIL</p>
  </div>
</div>
{% endblock %}