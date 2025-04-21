document.addEventListener("DOMContentLoaded", () => {
  fetch("../backend/getSkills.php")
    .then(response => response.json())
    .then(data => {
      const container = document.querySelector(".skills-grid");
      container.innerHTML = "";

      if (data.length === 0) {
        container.innerHTML = "<p>No skills shared yet.</p>";
      }

      data.forEach(skill => {
        const card = document.createElement("div");
        card.className = "skill-card";
        card.innerHTML = `
          <i class="fas fa-lightbulb skill-icon"></i>
          <div class="skill-details">
            <h3>${skill.skillTitle}</h3>
            <p><strong>Offered by:</strong> ${skill.userName}</p>
            <p><strong>Wants:</strong> ${skill.wantSkill}</p>
            <a href="#" class="trade-btn">Request Trade</a>
          </div>
        `;
        container.appendChild(card);
      });
    })
    .catch(err => {
      console.error("❌ Failed to load skills:", err);
    });
});
