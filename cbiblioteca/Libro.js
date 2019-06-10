
export default class Libro{
	constructor(id=0, nombre='', bibliotecario=0){
		if(typeof id == 'object'){
			this.id = id.id;
			this.nombre = id.nombre;
			this.bibliotecario = id.bibliotecario;
		}else{
			this.id = id;
			this.nombre = nombre;
			this.bibliotecario = bibliotecario;
		}
	}
};