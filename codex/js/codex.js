/*////////////// CODE REFERENCE //////////////// */

// Click Target
if( e.target && e.target.tagName === 'A'){

}

// Recorrer nodeList
Array.from(nodeList).forEach(elemento => {

});

/*///////////////// FOR OF IN ////////////////// */
// El for in es utilizado tanto para objetos como para arrays
// El for of es utilizado solo para arrays

const user = {
    name: 'Nicolas',
    age: 43,
    info: function(){
        console.log('info')
    }
}


const names = ['Nicolas','Josefina','Maria'];

// FOR OF
for (let name in names ) {
    console.log(name)   // en el caso de un objeto devuelve el indice de cada elemento
}

// FOR IN

// for in de objetos
for (let index in user ) {

    console.log(index) // en el caso de un objeto devuelve las claves de las propiedades o funciones
    console.log(user[index]); // en este caso devuelve el valor de cada elemento del objeto
    
}

// for in de arrays
for (let index in names ) {
    console.log(index) // en el caso de un objeto devuelve el indice de cada elemento
    console.log(user[index]); // en este caso devuelve el valor de cada elemento del objeto
}

