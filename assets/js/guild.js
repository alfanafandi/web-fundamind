document.addEventListener("DOMContentLoaded", () => {
  const guildMaster = document.getElementById("guildMaster");
  const guildModal = document.getElementById("guildModal");
  const chatText = document.getElementById("chatText");
  const nextChat = document.getElementById("nextChat");

  const chatMessages = [
    "Selamat Datang Di Guild!",
    "Di sini kamu bisa menemukan quest dan petualangan.",
    "Jangan ragu untuk menjelajah dan meminta bantuan.",
    "Semoga sukses dalam perjalananmu!",
  ];
  let currentMessageIndex = 0;

  guildMaster.addEventListener("click", () => {
    guildModal.classList.remove("hidden");
    chatText.textContent = chatMessages[currentMessageIndex];
  });

  nextChat.addEventListener("click", () => {
    currentMessageIndex++;
    if (currentMessageIndex < chatMessages.length) {
      chatText.textContent = chatMessages[currentMessageIndex];
    } else {
      guildModal.classList.add("hidden");
      currentMessageIndex = 0;
    }
  });
});
