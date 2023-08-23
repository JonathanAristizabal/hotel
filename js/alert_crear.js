function mostrarConfirmacionRegistro() {
    if (confirm("Registro exitoso. ¿Deseas ir a la página de inicio de sesión?")) {
        window.location.href = "panel_gestor.php";
    }
}

