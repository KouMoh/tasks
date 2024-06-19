<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management CRUD | PHP CRUD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container my-5">
    <button class="btn btn-primary" id="newEmployeeBtn" onclick="showNewEmployeeForm()">New Employee</button>
    <br><br>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="employeeTable">
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="employeeModalLabel">Employee Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="employeeForm" onsubmit="saveEmployee(event)">
                    <input type="hidden" id="employeeId" name="id">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <button type="submit" class="btn btn-primary" id="saveEmployeeBtn">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    loadEmployees();
});

function loadEmployees() {
    $.ajax({
        url: 'read.php',
        type: 'GET',
        success: function(response) {
            let employees = JSON.parse(response);
            renderEmployeeTable(employees);
        }
    });
}

function renderEmployeeTable(employees) {
    let rows = '';
    employees.forEach((employee, index) => {
        rows += `
            <tr>
                <td>${index + 1}</td>
                <td>${employee.name}</td>
                <td>${employee.email}</td>
                <td>${employee.phone}</td>
                <td>${employee.address}</td>
                <td>${employee.created_at}</td>
                <td>
                    <button class='btn btn-primary btn-sm' onclick='editEmployee(${JSON.stringify(employee)})'>Edit</button>
                    <button class='btn btn-danger btn-sm' onclick='deleteEmployee(${employee.id})'>Delete</button>
                </td>
            </tr>
        `;
    });
    $('#employeeTable').html(rows);
}

function showNewEmployeeForm() {
    $('#employeeModal').modal('show');
    $('#employeeForm')[0].reset();
    $('#employeeId').val('');
}

function saveEmployee(event) {
    event.preventDefault();
    let id = $('#employeeId').val();
    let name = $('#name').val();
    let email = $('#email').val();
    let phone = $('#phone').val();
    let address = $('#address').val();
    let createdAt = new Date().toISOString().split('T')[0]; 

    let formData = { id, name, email, phone, address, created_at: createdAt };
    let url = id ? 'update.php' : 'create.php';
    
    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        success: function(response) {
            alert(response);
            $('#employeeModal').modal('hide');
            loadEmployees();
        }
    });
}

function editEmployee(employee) {
    $('#employeeId').val(employee.id);
    $('#name').val(employee.name);
    $('#email').val(employee.email);
    $('#phone').val(employee.phone);
    $('#address').val(employee.address);
    $('#employeeModal').modal('show');
}


function deleteEmployee(id) {
    if (confirm('Are you sure you want to delete this employee?')) {
        $.ajax({
            url: 'delete.php',
            type: 'POST',
            data: { id },
            success: function(response) {
                loadEmployees();
            }
        });
    }
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
