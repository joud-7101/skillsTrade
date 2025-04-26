document.addEventListener("DOMContentLoaded", () => {
  fetch("../backend/getCommunityTrades.php")
    .then(res => res.json())
    .then(data => {
      const container = document.querySelector(".community-grid");
      container.innerHTML = ""; // clear static content

      data.forEach(user => {
        const card = document.createElement("div");
        card.className = "trade-card";
        card.innerHTML = `
          <div class="user-info">
            <img src="../MEDIA/juicy-girl.png" alt="Profile Image" />
            <h3>${user.name} <span class="badge offering">Offering</span></h3>
          </div>
          <p class="skill"><i class="fas fa-star"></i> ${user.offerSkill}</p>
          <p class="wants"><i class="fas fa-exchange-alt"></i> Wants: ${user.wantSkill}</p>
          <button class="connect-btn"><i class="fas fa-handshake"></i> Connect</button>
        `;
        container.appendChild(card);
      });
    })
    .catch(err => console.error("Failed to fetch community trades:", err));
});
