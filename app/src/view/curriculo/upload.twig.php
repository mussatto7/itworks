{% extends 'partials/template.twig.php' %}

{%block title%} JOB APPLICATION | Enviar Arquivo {% endblock %}

{% block body %}

<form action="/arquivo-salvar" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="{{id}}">
    <div class="mb-3">
        <label for="arquivo" class="form-label">Curriculo em Arquivo1</label>
        <input type="file" name="curriculo" class="form-control" id="arquivo" aria-describedby="arquivoHelp">
        <p id="arquivoHelp" class="form-text">Envie seu Currículo.</p>
    </div>
    <button type="submit" class="btn btn-primary">ENVIAR CURRÍCULO</button>
</form>
{% endblock %}