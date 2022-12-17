{% extends 'partials/template.twig.php' %}

{% block title %} {{titulo}} {% endblock %}

{% block body %}

<div class="max-width center-screen bg-white padding mt-5">

    <h1>{{titulo}}</h1>

    <hr>

    <p>{{decricao}}</p>

    {% if link != null %}
    <a href="{{link}}" class="btn btn-info">Voltar</a>
    {% endif %}
</div>

{% endblock %}