function validateForm() {
    // Get form inputs
    var name = document.getElementById("name").value.trim();
    var category = document.getElementById("category").value.trim();
    var image = document.getElementById("image").value.trim();
    var productionDate = document.getElementById("productionDate").value.trim();

    // Check if required fields are filled
    if (name === "" || category === "" || image === "" || productionDate === "") {
        alert("All fields are required");
        return false;
    }

    // Check if the production date is a valid date
    var dateRegex = /^\d{4}-\d{2}-\d{2}$/;
    if (!productionDate.match(dateRegex)) {
        alert("Production date must be in YYYY-MM-DD format");
        return false;
    }

    // Check if the production date is within the allowed range (maximum of 3 months back)
    var currentDate = new Date();
    var maxDate = new Date();
    maxDate.setMonth(maxDate.getMonth() - 3);

    var inputDate = new Date(productionDate);
    if (inputDate > currentDate || inputDate < maxDate) {
        alert("Production date must be within the last 3 months");
        return false;
    }

    // If all validations pass, return true
    return true;
}
