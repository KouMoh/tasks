// const globals = document.querySelectorAll('.global');

// globals.forEach((element) => {
//   element.onclick = display =() => {
//     document.getElementById('res').value += element.value;
//     console.log('Button clicked');
//   };
// });



const buttons = document.querySelectorAll('.global');


const resultField = document.getElementById('res');


buttons.forEach(button => {
  button.addEventListener('click', () => {
    const value = button.value;


    if (value === '√') {
      const result = Math.sqrt(parseFloat(resultField.value));
      resultField.value = result;
    } else {

      resultField.value += value;
    }
  });
});