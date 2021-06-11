function populateSelect(result,data,defaultValue = true){ 
    $("#"+data.destination).populate(result,{
            onPopulate: function (opts) {
                if(defaultValue == true)
                    $(this).prepend('<option value="NULL" selected>Ninguno</option>');
            }
    });
    if(data.valor)
        $("#"+data.destination).val(data.valor);
}

$( document ).ready(function() {
    populateSelect( data, { destination: "grupo" } );
}); 

var data = [{
    "1": "Amazonas",
    "2": "Antioquia",
    "3": "Arauca",
    "4": "Atlántico",
    "5": "Bolívar",
    "6": "Boyacá",
    "7": "Caldas",
    "8": "Caquetá",
    "9": "Casanare",
    "10": "Cauca",
    "11": "Cesar",
    "12": "Chocó",
    "13": "Córdoba",
    "14": "Cundinamarca",
    "15": "Güainia",
    "16": "Guaviare",
    "17": "Huila",
    "18": "La Guajira",
    "19": "Magdalena",
    "20": "Meta",
    "21": "Nariño",
    "22": "Norte de Santander",
    "23": "Putumayo",
    "24": "Quindo",
    "25": "Risaralda",
    "26": "San Andrés y Providencia",
    "27": "Santander",
    "28": "Sucre",
    "29": "Tolima",
    "30": "Valle del Cauca",
    "31": "Vaupés",
    "32": "Vichada"
  }];