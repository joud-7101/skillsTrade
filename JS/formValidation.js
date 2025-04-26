document.addEventListener("DOMContentLoaded", () => {
  // Registration form password match
  const regForm = document.querySelector("form[action*='register.php']");
  if (regForm) {
    regForm.addEventListener("submit", function (e) {
      const pass = regForm.querySelector("#password").value;
      const confirm = regForm.querySelector("#confirmPassword").value;
      if (pass !== confirm) {
        alert("Passwords do not match.");
        e.preventDefault();
      }
    });
  }

  // Login form validation
  const loginForm = document.querySelector("form[action*='login.php']");
  if (loginForm) {
    loginForm.addEventListener("submit", function (e) {
      const email = loginForm.querySelector("#email").value;
      if (!email.includes("@")) {
        alert("Please enter a valid email.");
        e.preventDefault();
      }
    });
  }

  // Contact form required fields
  const contactForm = document.querySelector("form[action*='contact.php']");
  if (contactForm) {
    contactForm.addEventListener("submit", function (e) {
      const name = contactForm.querySelector("#name").value;
      const email = contactForm.querySelector("#email").value;
      if (!name || !email.includes("@")) {
        alert("Fill out all required fields.");
        e.preventDefault();
      }
    });
  }

  // Share Skill form validation
  const skillForm = document.querySelector("form[action*='upload.php']");
  if (skillForm) {
    skillForm.addEventListener("submit", function (e) {
      const skill = skillForm.querySelector("#skillTitle").value;
      const want = skillForm.querySelector("#wantSkill").value;
      const desc = skillForm.querySelector("#description").value;
      if (!skill || !want || !desc) {
        alert("Please fill out all required fields.");
        e.preventDefault();
      }
    });
  }
});
