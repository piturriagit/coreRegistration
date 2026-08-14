from behave import given, when, then
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time
from features.utils import take_screenshot


BASE_URL = "http://localhost:8000"

@given('estoy en la página "{page}"')
def step_abrir_pagina(context, page):
    context.driver.get(f"{BASE_URL}/{page}")


@when('introduzco el nombre "{nombre}"')
def step_introducir_nombre(context, nombre):
    campo = context.driver.find_element(By.ID, "nombre")
    campo.send_keys(nombre)


@when('introduzco el email "{email}"')
def step_introducir_email(context, email):
    context.email = email
    campo = context.driver.find_element(By.ID, "email")
    campo.send_keys(email)

@when("introduzco un email único generado automáticamente")
def step_introducir_email_unico(context):
    timestamp = int(time.time())
    email = f"new.{timestamp}@test.com"
    context.email = email
    campo = context.driver.find_element(By.ID, "email")
    campo.send_keys(email)

@when("pulso el botón Guardar")
def step_pulsar_guardar(context):
    boton = context.driver.find_element(
        By.CSS_SELECTOR,
        "button[type='submit']"
    )
    take_screenshot(context, "before_submit_form")
    boton.click()

@when("estoy en la lista de usuarios")
def step_acceder_lista_usuarios(context):
    context.driver.get(f"{BASE_URL}/usuarios.php")

@then("debería aparecer el mensaje de éxito de registro")
def step_comprobar_exito(context):
    WebDriverWait(context.driver, 10).until(
        EC.url_contains("success.html")
    )
    take_screenshot(context, "successful_registration")
    titulo = context.driver.find_element(By.ID, "title")
    assert "ℹ️ Usuario creado correctamente" in titulo.text
    descripcion = context.driver.find_element(By.ID, "descripcion")
    assert "Tu cuenta de usuario ha sido añadida a la base de datos." in descripcion.text


@then("debería aparecer el error de email en uso")
def step_comprobar_email_existente(context):
    WebDriverWait(context.driver, 10).until(
        EC.url_contains("error.php")
    )
    take_screenshot(context, "erroneous_registration_repeated_email")
    titulo = context.driver.find_element(By.ID, "title")
    assert titulo.text == "⚠️ Email en uso"
    mensaje = context.driver.find_element(By.ID, "descripcion")
    assert "Ya existe un usuario con este correo electrónico:" in mensaje.text
    assert context.email in mensaje.text
    assert "Por favor, elige otro correo electrónico." in mensaje.text

@then("debería aparecer un error en el formulario para email")
def step_comprobar_error_consulta(context):
    take_screenshot(context, "erroneous_registration_invalid_email")
    email = context.driver.find_element(By.ID, "email")
    tipo_invalido = context.driver.execute_script("return arguments[0].validity.typeMismatch;",email)
    assert tipo_invalido is True, "El navegador debería detectar un email con formato inválido"

@then("debería aparecer un error en el formulario para nombre")
def step_comprobar_error_nombre(context):
    take_screenshot(context, "erroneous_registration_missing_name")
    nombre = context.driver.find_element(By.ID, "nombre")
    valor_vacio = context.driver.execute_script("return arguments[0].validity.valueMissing;",nombre)
    assert valor_vacio is True, "El navegador debería detectar un nombre vacío como inválido"

@then(u'debería aparecer el usuario registrado')
def step_impl(context):
    usuario = WebDriverWait(context.driver, 10).until(
        EC.presence_of_element_located(
            (By.XPATH, f"//*[contains(text(), '{context.email}')]")
        )
    )
    context.driver.execute_script(
        "arguments[0].scrollIntoView({block: 'center'});",
        usuario
    )
    take_screenshot(context, "successful_registration_list")
    assert context.email in usuario.text, (
        f"No se encontró el email {context.email}"
    )


@then(u'no debería aparecer el email repetido')
def step_impl(context):
    WebDriverWait(context.driver, 10).until(
        EC.url_contains("usuarios.php")
    )
    context.driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
    take_screenshot(context, "erroneous_registration_repeated_email_list")
    
    elementos = context.driver.find_elements(
        By.XPATH,
        f"//*[contains(text(), '{context.email}')]"
    )
    assert len(elementos) == 1, (
        f"Se encontró el email {context.email} repetido"
    )
