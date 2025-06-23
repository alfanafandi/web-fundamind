document.addEventListener("DOMContentLoaded", () => {
  const guildMaster = document.getElementById("guildMaster");
  const guildModal = document.getElementById("guildModal");
  const chatText = document.getElementById("chatText");
  const nextChat = document.getElementById("nextChat");

  const chatMessages = [
    "Welcome to the guild!",
    "Here you can find quests and adventures.",
    "Feel free to explore and ask for help.",
    "Good luck on your journey!",
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
