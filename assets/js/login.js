
function error_credenciales() {
  Swal({
    title: 'Falla de autenticación',
    text: 'Verifique sus credenciales',
    type: 'error'
  })
}

function usuario_bloqueado() {
  Swal({
    title: 'Bloqueado',
    text: 'Usuario bloqueado por el administrador',
    type: 'error'
  })
}
