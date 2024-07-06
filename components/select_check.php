<script>
function limitCheckboxSelection() {
            var smbCheckboxes = document.querySelectorAll('input[name="smb[]"]');
            var baseCheckboxes = document.querySelectorAll('input[name="base[]"]');
            var ingredientCheckboxes = document.querySelectorAll('input[name="Ingredients[]"]');
            var topproseCheckboxes = document.querySelectorAll('input[name="topprose[]"]');
            var toppremCheckboxes = document.querySelectorAll('input[name="topprem[]"]');




            
            for (var i = 0; i < smbCheckboxes.length; i++) {
                smbCheckboxes[i].addEventListener('change', function() {
                    if (this.checked) 
                      if (this.checked) {
                // Disable topprem checkboxes if Small or Medium is selected
                if (this.value === "Small" || this.value === "Medium") {
                    for (var j = 0; j < toppremCheckboxes.length; j++) {
                        toppremCheckboxes[j].disabled = true;
                        toppremCheckboxes[j].checked = false;
                    }
                } else {
                    // Enable topprem checkboxes for other sizes
                    for (var j = 0; j < toppremCheckboxes.length; j++) {
                        toppremCheckboxes[j].disabled = false;
                    }
                }
            }
            {
                        for (var j = 0; j < smbCheckboxes.length; j++) {
                            smbCheckboxes[j].checked = false;
                        }
                        this.checked = true;

                        // Enable all base checkboxes if Small is selected
                        if (this.value === "Small" || this.value === "Medium" || this.value === "Big") {
                            for (var k = 0; k < baseCheckboxes.length; k++) {
                                baseCheckboxes[k].disabled = false;
                            }

                            // Enable all ingredient checkboxes
                            for (var l = 0; l < ingredientCheckboxes.length; l++) {
                                ingredientCheckboxes[l].disabled = false;
                            }

                            // Enable all topprose checkboxes
                            for (var m = 0; m < topproseCheckboxes.length; m++) {
                                topproseCheckboxes[m].disabled = false;
                            }
                        } 



                        else {
                            // Disable all base checkboxes for Medium and Big
                            for (var k = 0; k < baseCheckboxes.length; k++) {
                                baseCheckboxes[k].disabled = true;
                                baseCheckboxes[k].checked = false;
                            }

                            // Disable all ingredient checkboxes
                            for (var l = 0; l < ingredientCheckboxes.length; l++) {
                                ingredientCheckboxes[l].disabled = true;
                                ingredientCheckboxes[l].checked = false;
                            }

                            // Disable all topprose checkboxes
                            for (var m = 0; m < topproseCheckboxes.length; m++) {
                                topproseCheckboxes[m].disabled = true;
                                topproseCheckboxes[m].checked = false;
                            }
                        }
                    }
                });


            }



// ==========================================================================================


// ==========================================================================================


   // Check only one base option
    for (var n = 0; n < baseCheckboxes.length; n++) {
        baseCheckboxes[n].addEventListener('change', function() {
            if (document.querySelector('input[name="smb[]"][value="Small"]').checked) {
                for (var o = 0; o < baseCheckboxes.length; o++) {
                    baseCheckboxes[o].checked = false;
                }
                this.checked = true;
            }
        });
    }

    // Check only five ingredients when Small is selected
    for (var p = 0; p < ingredientCheckboxes.length; p++) {
        ingredientCheckboxes[p].addEventListener('change', function() {
            if (document.querySelector('input[name="smb[]"][value="Small"]').checked) {
                var checkedCount = 0;
                for (var q = 0; q < ingredientCheckboxes.length; q++) {
                    if (ingredientCheckboxes[q].checked) {
                        checkedCount++;
                    }
                }
                if (checkedCount > 5) {
                    this.checked = false;
                }
            }
        });
    }



    // Check only one topprose option
    for (var n = 0; n < topproseCheckboxes.length; n++) {
        topproseCheckboxes[n].addEventListener('change', function() {
            if (document.querySelector('input[name="smb[]"][value="Small"]').checked) {
                for (var o = 0; o < topproseCheckboxes.length; o++) {
                    topproseCheckboxes[o].checked = false;
                }
                this.checked = true;
            }
        });
    }




    // Check only two base options when Medium is selected
    for (var ab = 0; ab < baseCheckboxes.length; ab++) {
        baseCheckboxes[ab].addEventListener('change', function() {
            if (document.querySelector('input[name="smb[]"][value="Medium"]').checked) {
                var checkedCount = 0;
                for (var ac = 0; ac < baseCheckboxes.length; ac++) {
                    if (baseCheckboxes[ac].checked) {
                        checkedCount++;
                    }
                }
                if (checkedCount > 2) {
                    this.checked = false;
                }
            }
        });
    }

    // Check only eight ingredients when Medium is selected
    for (var w = 0; w < ingredientCheckboxes.length; w++) {
        ingredientCheckboxes[w].addEventListener('change', function() {
            if (document.querySelector('input[name="smb[]"][value="Medium"]').checked) {
                var checkedCount = 0;
                for (var f = 0; f < ingredientCheckboxes.length; f++) {
                    if (ingredientCheckboxes[f].checked) {
                        checkedCount++;
                    }
                }
                if (checkedCount > 8) {
                    this.checked = false;
                }
            }
        });
    }


    // Check only two topprose options when Medium is selected
    for (var tp = 0; tp < topproseCheckboxes.length; tp++) {
        topproseCheckboxes[tp].addEventListener('change', function() {
            if (document.querySelector('input[name="smb[]"][value="Medium"]').checked) {
                var checkedCount = 0;
                for (var fp = 0; fp < topproseCheckboxes.length; fp++) {
                    if (topproseCheckboxes[fp].checked) {
                        checkedCount++;
                    }
                }
                if (checkedCount > 2) {
                    this.checked = false;
                }
            }
        });
    }








    // Check only two base options when Medium is selected
    for (var ab = 0; ab < baseCheckboxes.length; ab++) {
        baseCheckboxes[ab].addEventListener('change', function() {
            if (document.querySelector('input[name="smb[]"][value="Big"]').checked) {
                var checkedCount = 0;
                for (var ac = 0; ac < baseCheckboxes.length; ac++) {
                    if (baseCheckboxes[ac].checked) {
                        checkedCount++;
                    }
                }
                if (checkedCount > 3) {
                    this.checked = false;
                }
            }
        });
    }



        // Check only eight ingredients when Medium is selected
    for (var w = 0; w < ingredientCheckboxes.length; w++) {
        ingredientCheckboxes[w].addEventListener('change', function() {
            if (document.querySelector('input[name="smb[]"][value="Big"]').checked) {
                var checkedCount = 0;
                for (var f = 0; f < ingredientCheckboxes.length; f++) {
                    if (ingredientCheckboxes[f].checked) {
                        checkedCount++;
                    }
                }
                if (checkedCount > 17) {
                    this.checked = false;
                }
            }
        });
    }



    // Check only two topprose options when Medium is selected
    for (var tp = 0; tp < topproseCheckboxes.length; tp++) {
        topproseCheckboxes[tp].addEventListener('change', function() {
            if (document.querySelector('input[name="smb[]"][value="Big"]').checked) {
                var checkedCount = 0;
                for (var fp = 0; fp < topproseCheckboxes.length; fp++) {
                    if (topproseCheckboxes[fp].checked) {
                        checkedCount++;
                    }
                }
                if (checkedCount > 2) {
                    this.checked = false;
                }
            }
        });
    }



    // Check only two topprose options when Medium is selected
    for (var tp = 0; tp < toppremCheckboxes.length; tp++) {
        toppremCheckboxes[tp].addEventListener('change', function() {
            if (document.querySelector('input[name="smb[]"][value="Big"]').checked) {
                var checkedCount = 0;
                for (var fp = 0; fp < toppremCheckboxes.length; fp++) {
                    if (toppremCheckboxes[fp].checked) {
                        checkedCount++;
                    }
                }
                if (checkedCount > 2) {
                    this.checked = false;
                }
            }
        });
    }

// ============================ les suppliment ===============================================

function calculateTotal() {
    var supingreCheckboxes = document.querySelectorAll('input[type="checkbox"][name="supingre[]"]:checked');
    var suptoppCheckboxes = document.querySelectorAll('input[type="checkbox"][name="suptopp[]"]:checked');
    var smbSalad = document.querySelector('input[type="checkbox"][name="smb[]"]:checked');

    var supingreTotal = supingreCheckboxes.length * 4; 
    var suptoppTotal = suptoppCheckboxes.length * 7;
    
    var price_per_unit = 0; // Define the variable here with a default value

    if (smbSalad) { // Check if a salad size is selected
        if (smbSalad.value === 'Small') { 
            price_per_unit = 35;
        } else if (smbSalad.value === 'Medium') {
            price_per_unit = 45;
        } else if (smbSalad.value === 'Big') {
            price_per_unit = 70;
        }
    }

    // Calculate the combined total
    var total = supingreTotal + suptoppTotal + price_per_unit;

    // Display the total in the input field
    document.getElementById('total').value = total.toFixed(2); 
}

var supingreCheckboxes = document.querySelectorAll('input[type="checkbox"][name="supingre[]"]');
var suptoppCheckboxes = document.querySelectorAll('input[type="checkbox"][name="suptopp[]"]');
var smbSaladCheckboxes = document.querySelectorAll('input[type="checkbox"][name="smb[]"]');

supingreCheckboxes.forEach(function(checkbox) {
    checkbox.addEventListener('click', calculateTotal);
});

suptoppCheckboxes.forEach(function(checkbox) {
    checkbox.addEventListener('click', calculateTotal);
});

smbSaladCheckboxes.forEach(function(checkbox) {
    checkbox.addEventListener('click', calculateTotal);
});

// ============================ end les suppliment ===============================================

}


    limitCheckboxSelection();
</script>
