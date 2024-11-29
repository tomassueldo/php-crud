document.addEventListener("DOMContentLoaded", () => {
    const editModal = document.getElementById("editModal");
    const deleteModal = document.getElementById("deleteModal");
    const overlay = document.createElement("div");
    overlay.classList.add("modal-overlay");
    document.body.appendChild(overlay);

    const editForm = document.getElementById("editForm");
    const confirmDeleteBtn = document.getElementById("confirmDelete");
    let currentEditId = null;
    let currentDeleteId = null;

    // Abrir el modal de edición
    document.querySelectorAll(".edit-btn").forEach((button) => {
        button.addEventListener("click", (e) => {
            const row = e.target.closest("tr");
            currentEditId = row.dataset.id; // Captura el ID desde data-id
            const cells = row.querySelectorAll("td");

            // Ajustar los valores del formulario ignorando la primera columna (ID)
            editForm.id.value = currentEditId; // Asigna el ID al campo oculto
            editForm.nombre.value = cells[1].textContent.trim(); // Nombre
            editForm.apellido.value = cells[2].textContent.trim(); // Apellido
            editForm.documento.value = cells[3].textContent.trim(); // Documento
            editForm.area.value = cells[4].textContent.trim(); // Código de Área
            editForm.telefono.value = cells[5].textContent.trim(); // Teléfono
            editForm.email.value = cells[6].textContent.trim(); // Email

            // Mostrar el modal
            editModal.classList.add("active");
            overlay.classList.add("active");
        });
    });


    // Enviar el formulario de edición
    editForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = Object.fromEntries(new FormData(editForm).entries());
        const response = await fetch(`/formulario`, {
            method: "PUT",
            body: JSON.stringify(formData),
            headers: { "Content-Type": "application/json" },
        });

        const result = await response.json();

        if (response.ok) {
            alert(result.message);
            location.reload();
        } else {
            alert(result.error);
        }
    });

    // Abrir el modal de confirmación de eliminación
    document.querySelectorAll(".delete-btn").forEach((button) => {
        button.addEventListener("click", (e) => {
            const row = e.target.closest("tr");
            currentDeleteId = row.dataset.id; // Captura el ID desde data-id

            deleteModal.classList.add("active");
            overlay.classList.add("active");
        });
    });

    // Confirmar eliminación
    confirmDeleteBtn.addEventListener("click", async () => {
        const response = await fetch(`/formulario`, {
            method: "DELETE",
            body: JSON.stringify({ id: currentDeleteId }), // Incluye el ID en el cuerpo de la solicitud
            headers: { "Content-Type": "application/json" },
        });

        const result = await response.json();

        if (response.ok) {
            alert(result.message);
            location.reload();
        } else {
            alert(result.error);
        }
    });

    // Cerrar modales
    overlay.addEventListener("click", closeModals);
    document.getElementById("cancelDelete").addEventListener("click", closeModals);

    function closeModals() {
        editModal.classList.remove("active");
        deleteModal.classList.remove("active");
        overlay.classList.remove("active");
    }
});
