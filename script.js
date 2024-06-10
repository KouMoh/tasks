        // const employees = [
        //     {
        //         id: 1,
        //         name: 'Mark',
        //         phone: '98982',
        //         address: 'mdo'
        //     },
        //     {
        //         id: 2,
        //         name: 'Jacob',
        //         phone: '5634525',
        //         address: 'fat'
        //     },
        //     {
        //         id: 3,
        //         name: 'Larry the Bird',
        //         phone: '38423048',
        //         address: 'yt'
        //     }
        // ];

        // document.getElementById('add-member').addEventListener('click', () => {
          
        //     const nameInput = document.getElementById('name');
        //     const phoneInput = document.getElementById('phone');
        //     const addressInput = document.getElementById('address');

            
        //     const isPhoneUnique = !employees.some(function(employee) {
        //         return employee.phone === phoneInput.value;
        //     });            

        //     if (!isPhoneUnique) {
        //         alert('Phone number must be unique.');
        //         return;
        //     }

           
        //     const newEmployee = {
        //         id: employees.length + 1,
        //         name: nameInput.value,
        //         phone: phoneInput.value,
        //         address: addressInput.value
        //     };

            
        //     employees.push(newEmployee);

           
        //     updateTable();

            
        //     const modal = bootstrap.Modal.getInstance(document.getElementById('staticBackdrop'));
        //     modal.hide();

            
        //     nameInput.value = '';
        //     phoneInput.value = '';
        //     addressInput.value = '';
        // });

        
        // function deleteEmployee(id) {
            
        //     const index = employees.findIndex(employee => employee.id === id);
        //     if (index !== -1) {
                
        //         employees.splice(index, 1);
               
        //         updateTable();
        //     }
        // }

        // // Function to update the table
        // function updateTable() {
        //     const tableBody = document.getElementById('employee-table-body');
        //     tableBody.innerHTML = '';

        //     // Loop through the employees array and create table rows
        //     employees.forEach((employee, index) => {
        //         const row = document.createElement('tr');
        //         row.innerHTML = `
        //             <th scope="row">${employee.id}</th>
        //             <td>${employee.name}</td>
        //             <td>${employee.phone}</td>
        //             <td>${employee.address}</td>
        //             <td><button class="btn btn-danger" onclick="deleteEmployee(${employee.id})">Delete</button></td>
        //         `;
        //         tableBody.appendChild(row);
        //     });
        // }

        // // Initialize the table
        // updateTable();



let employees = [];
let index =0;


function fetchEmployees() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '/employees.json');
    
    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
            employees = JSON.parse(xhr.responseText);
            updateTable();
        } else {
            console.error('Error fetching employees:', xhr.statusText);
        }
    };
    
    xhr.send();
}


function saveEmployees() {
    const xhr = new XMLHttpRequest();
    
    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
            console.log('Employees saved successfully.');
        } else {
            console.error('Failed to save employees:', xhr.statusText);
        }
    };
    
    xhr.open('POST', '/save-employees');
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify(employees));
}


document.getElementById('add-member').addEventListener('click', () => {
 
    const nameInput = document.getElementById('name');
    const phoneInput = document.getElementById('phone');
    const addressInput = document.getElementById('address');

    
    const isPhoneUnique = !employees.some(function(employee) {
        return employee.phone === phoneInput.value;
    });

    if (!isPhoneUnique) {
        alert('Phone number must be unique.');
        return;
    }

    
    const newEmployee = {
        name: nameInput.value,
        phone: phoneInput.value,
        address: addressInput.value
    };


    employees.push(newEmployee);

 
    updateTable();


    saveEmployees();


    const modal = bootstrap.Modal.getInstance(document.getElementById('staticBackdrop'));
    modal.hide();


    nameInput.value = '';
    phoneInput.value = '';
    addressInput.value = '';
});


function deleteEmployee(index) {
    employees.splice(index, 1);
    updateTable();
    saveEmployees();
}


function updateTable() {
    const tableBody = document.getElementById('employee-table-body');
    tableBody.innerHTML = '';


    employees.forEach((employee, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <th scope="row">${index + 1}</th>
            <td>${employee.name}</td>
            <td>${employee.phone}</td>
            <td>${employee.address}</td>
            <td><button class="btn btn-danger" onclick="deleteEmployee(${index})">Delete</button></td>
        `;
        tableBody.appendChild(row);
    });
}


fetchEmployees();
