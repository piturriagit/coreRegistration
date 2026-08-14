Feature: Registro de usuarios

    @registro.001
    Scenario: Registrar un usuario correctamente
        Given estoy en la página "home.html"
        When introduzco el nombre "Usuario Test"
        And introduzco un email único generado automáticamente
        And pulso el botón Guardar
        Then debería aparecer el mensaje de éxito de registro
        When estoy en la lista de usuarios
        Then debería aparecer el usuario registrado

    @registro.002
    Scenario: Intentar registrar un email existente
        Given estoy en la página "home.html"
        When introduzco el nombre "Usuario repetido"
        And introduzco el email "repeated.user@test.com"
        And pulso el botón Guardar
        Then debería aparecer el error de email en uso
        When estoy en la lista de usuarios
        Then no debería aparecer el email repetido

    @registro.003
    Scenario: Intentar registrar un email inválido
        Given estoy en la página "home.html"
        When introduzco el nombre "Usuario Test"
        And introduzco el email "email-invalido"
        And pulso el botón Guardar
        Then debería aparecer un error en el formulario para email

    @registro.004
    Scenario: Intentar registrar un nombre inválido
        Given estoy en la página "home.html"
        When introduzco el email "usuario.test.001@example.com"
        And pulso el botón Guardar
        Then debería aparecer un error en el formulario para nombre

