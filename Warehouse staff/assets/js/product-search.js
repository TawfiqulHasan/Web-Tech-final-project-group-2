function searchProduct(){

    let keyword = document.getElementById("search").value;

    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function(){

        if(this.readyState == 4 && this.status == 200){

            let data = JSON.parse(this.responseText);

            let output = "";

            if(data.length == 0){

                output = `
                <tr>
                    <td colspan="8">No product found</td>
                </tr>`;
            }
            else{

                for(let i = 0; i < data.length; i++){

                    output += `
                    <tr>
                        <td>${data[i].id}</td>
                        <td>${data[i].name}</td>
                        <td>${data[i].sku}</td>
                        <td>${data[i].category_name ?? "No Category"}</td>
                        <td>${data[i].current_stock}</td>
                        <td>${data[i].reorder_level}</td>
                        <td>${data[i].zone_code ?? "Not Assigned"}</td>
                        <td>${data[i].bin_code ?? "Not Assigned"}</td>
                    </tr>`;
                }
            }

            document.getElementById("searchResult").innerHTML = output;
        }
    };

    xhttp.open(
        "GET",
        "../../controller/ProductController.php?search=" + keyword,
        true
    );

    xhttp.send();
}

window.onload = function(){
    searchProduct();
};