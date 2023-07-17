import Swal from 'sweetalert2'

export function alert(type, title, text) {
    const types = ['success', 'error', 'warning', 'info', 'question'];
    if (!types.includes(type)) {
        type = 'info'
    }

    return Swal.fire({
      title: title,
      text: text,
      icon: type,
      confirmButtonText: 'Ok'
    })
}
