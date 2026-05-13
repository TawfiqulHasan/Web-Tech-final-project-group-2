function searchProduct(){

    let keyword =
    document.getElementById("search").value;

    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function(){

        if(this.readyState == 4 &&
           this.status == 200){

            let data =
            JSON.parse(this.responseText);

            let output = "";

            for(let i=0; i<data.length; i++){

                output += `
                <tr>

                    <td>${data[i].id}</td>

                    <td>${data[i].name}</td>

                    <td>${data[i].sku}</td>

                    <td>${data[i].current_stock}</td>

                    <td>${data[i].reorder_level}</td>

                </tr>
                `;
            }

            document.getElementById("searchResult")
            .innerHTML = output;
        }
    };

    xhttp.open(
        "GET",
        "../../controller/ProductController.php?search="
        + keyword,
        true
    );

    xhttp.send();
}