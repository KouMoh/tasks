
function givePrime() {
    let num1 = parseInt(document.getElementById('p1').value);
    let num2 = parseInt(document.getElementById('p2').value);
    let primes = [];
    
    for (let i = num1; i <= num2; i++) {
        if (i < 2) continue;
        
        let isPrime = true;
        for (let j = 2; j <= Math.sqrt(i); j++) {
            if (i % j === 0) {
                isPrime = false;
                break;
            }
        }
        
        if (isPrime) {
            primes.push(i);
        }
    }
    
    document.getElementById('result1').innerHTML = primes.join(', ');
}


function reverse(){
    let nums = parseFloat(document.getElementById('reverse').value);
    let ans = 0;
    let temp = nums; 
    while(temp > 0){
        ans = ans * 10 + temp % 10;
        temp = Math.floor(temp / 10); 
    }
    document.getElementById('result2').innerHTML = ans;
}

// function reverse() {
//     let nums = document.getElementById('reverse').value;
//     let isNegative = false;
//     if (nums < 0) {
//       isNegative = true;
//       nums = Math.abs(nums);
//     }
  
//     let [intPart, decPart] = nums.toString().split('.');
//     let ans = 0;
//     let temp = parseInt(intPart);
  
//     while (temp > 0) {
//       ans = ans * 10 + temp % 10;
//       temp = Math.floor(temp / 10);
//     }
  
//     if (decPart) {
//       ans = ans + '.' + decPart.split('').reverse().join('');
//     }
  
//     if (isNegative) {
//       ans = '-' + ans;
//     }
  
//     document.getElementById('result2').innerHTML = ans;
//   }


function findGreatest(){
    let num1 =parseFloat(document.getElementById('1').value)
    let num2 =parseFloat(document.getElementById('2').value)
    let num3 =parseFloat(document.getElementById('3').value)
    let num4 =parseFloat(document.getElementById('4').value)
    let num5 =parseFloat(document.getElementById('5').value)

    let nums =[num1,num2,num3,num4,num5]

    let high = Number.MIN_VALUE;

    for(let i=0; i<5; i++){
        if(nums[i] > high){
            high = nums[i];
        }
    }

    document.getElementById('result3').innerHTML = high;




}



