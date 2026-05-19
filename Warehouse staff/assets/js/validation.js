function checkPositiveQuantity(quantity){

    if(quantity == ""){
        alert("Quantity is required");
        return false;
    }

    if(quantity <= 0){
        alert("Quantity must be greater than 0");
        return false;
    }

    return true;
}

function validateStockIn(){

    let product = document.getElementsByName("product_id")[0].value;
    let quantity = document.getElementsByName("quantity")[0].value;
    let unitPrice = document.getElementsByName("unit_price")[0].value;
    let date = document.getElementsByName("transaction_date")[0].value;

    if(product == ""){
        alert("Please select product");
        return false;
    }

    if(!checkPositiveQuantity(quantity)){
        return false;
    }

    if(unitPrice == "" || unitPrice < 0){
        alert("Unit price is required and cannot be negative");
        return false;
    }

    if(date == ""){
        alert("Transaction date is required");
        return false;
    }

    return true;
}

function validateStockOut(){

    let product = document.getElementsByName("product_id")[0].value;
    let quantity = document.getElementsByName("quantity")[0].value;
    let reason = document.getElementsByName("reason")[0].value;
    let date = document.getElementsByName("transaction_date")[0].value;

    if(product == ""){
        alert("Please select product");
        return false;
    }

    if(!checkPositiveQuantity(quantity)){
        return false;
    }

    if(reason == ""){
        alert("Please select reason");
        return false;
    }

    if(date == ""){
        alert("Transaction date is required");
        return false;
    }

    return true;
}

function validateAdjustment(){

    let product = document.getElementsByName("product_id")[0].value;
    let quantity = document.getElementsByName("quantity")[0].value;
    let reason = document.getElementsByName("reason")[0].value;

    if(product == ""){
        alert("Please select product");
        return false;
    }

    if(quantity == ""){
        alert("Adjustment quantity is required");
        return false;
    }

    if(reason == ""){
        alert("Reason is required");
        return false;
    }

    return true;
}

function validateDiscrepancy(){

    let product = document.getElementsByName("product_id")[0].value;
    let expected = document.getElementsByName("expected_qty")[0].value;
    let actual = document.getElementsByName("actual_qty")[0].value;
    let description = document.getElementsByName("description")[0].value;

    if(product == ""){
        alert("Please select product");
        return false;
    }

    if(expected == "" || expected < 0){
        alert("Expected quantity is required and cannot be negative");
        return false;
    }

    if(actual == "" || actual < 0){
        alert("Actual quantity is required and cannot be negative");
        return false;
    }

    if(description == ""){
        alert("Description is required");
        return false;
    }

    return true;
}
function validateProfile(){

    let phone = document.getElementsByName("phone")[0].value;
    let password = document.getElementsByName("password")[0].value;

    if(phone == "" && password == ""){
        alert("Phone or password is required");
        return false;
    }

    if(phone != "" && phone.length != 11){
        alert("Phone number must be exactly 11 digits");
        return false;
    }

    if(phone != "" && isNaN(phone)){
        alert("Phone number must contain only digits");
        return false;
    }

    if(password != "" && password.length < 4){
        alert("Password must be at least 4 characters");
        return false;
    }

    return true;
}