document.addEventListener("DOMContentLoaded", () => {
  
    function showPassword(inputName) {
        const passwordField = document.getElementsByName(inputName)[0];
        
        if (passwordField.type === "password") {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    }
  
    const addUserForm = document.querySelector(".floating-add-user-form form");
    const addUserButton = document.querySelector(".admin-activities button");
    const mainContent = document.querySelector("div.app");
    const closeAddUserButton = document.getElementById("cancelButton");
    const formInputs = document.querySelectorAll(".floating-add-user-form input");

    document.getElementById("showCurrentPassword").addEventListener("click", function() {
        togglePasswordVisibility('currentPassword');
    });
    
    document.getElementById("showNewPassword").addEventListener("click", function() {
        togglePasswordVisibility('newPassword');
    });
    
    document.getElementById("showConfirmPassword").addEventListener("click", function() {
        togglePasswordVisibility('confirmPassword');
    });
  
    // Debugging: Check if the form is selected correctly
    console.log(addUserForm);
  
    if (addUserForm) {
      addUserButton.addEventListener("click", () => {
        console.log("Add User button clicked");
        addUserForm.parentElement.style.display = "block";
        addUserForm.parentElement.style.pointerEvents = "auto";
        mainContent.classList.add("blur");
        mainContent.style.pointerEvents = "none";
      });
    }
  
      if (closeAddUserButton) {
        closeAddUserButton.addEventListener("click", (event) => {
          event.preventDefault(); // prevent the form from submitting
          console.log("Cancel button clicked");
          addUserForm.parentElement.style.display = "none";
          mainContent.classList.remove("blur");
          mainContent.style.pointerEvents = "auto";
          addUserForm.reset(); // reset the fields
        });
      } else {
        console.error("Cancel button not found");
      }
  
      formInputs.forEach((input) => {
        input.addEventListener("focus", () => {
          input.previousElementSibling.classList.add("active");
        });
      });
  
      formInputs.forEach((input) => {
        input.addEventListener("blur", () => {
          if (input.value === "") {
            input.previousElementSibling.classList.remove("active");
          }
        });
      });
      // Call toggleFields on page load to set the initial state
      toggleFields();
      toggleFieldsEmp();
  
      // Add event listener to role select element
      document.getElementById("role").addEventListener("change", toggleFields);
      document.getElementById("jobstatus").addEventListener("change", toggleFieldsEmp);
  
      addUserForm.addEventListener("submit", async (event) => {
        event.preventDefault(); // prevent the default form submission
    
        try {
          const formData = new FormData(addUserForm);
          const response = await fetch(addUserForm.action, {
            method: "POST",
            body: formData,
          });
    
          if (response.ok) {
            alert("User added successfully.");
            addUserForm.parentElement.style.display = "none";
            mainContent.classList.remove("blur");
            mainContent.style.pointerEvents = "auto";
            addUserForm.reset(); // reset the fields
          } else {
            const errorText = await response.text();
            console.error("Error adding user:", errorText);
            alert("Error adding user: " + errorText);
          }
        } catch (error) {
          console.error("Error adding user:", error);
          alert("Error adding user: " + error.message);
        }
      });
  });