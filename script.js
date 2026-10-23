const bookingForm = document.getElementById("bookingForm");
const bookingDate = document.getElementById("bookingDate");
const guestCount = document.getElementById("guestCount");
const tableOptions = [...document.querySelectorAll(".table-option")];
const tableHint = document.getElementById("tableHint");
const formError = document.getElementById("formError");
const successPanel = document.getElementById("successPanel");
const confirmationDetails = document.getElementById("confirmationDetails");
const menuToggle = document.getElementById("menuToggle");
const navLinks = document.getElementById("navLinks");
let selectedTable = "";

function localDateString(date = new Date()) {
  const year = date.getFullYear();
  const month = String(date.getMonth() + 1).padStart(2, "0");
  const day = String(date.getDate()).padStart(2, "0");
  return `${year}-${month}-${day}`;
}
bookingDate.min = localDateString();

function updateTables() {
  const guests = Number(guestCount.value || 0);
  let availableCount = 0;
  tableOptions.forEach(button => {
    const seats = Number(button.dataset.seats);
    const fits = !guests || seats >= guests;
    button.classList.toggle("disabled", !fits);
    button.disabled = !fits;
    if (fits) availableCount++;
    if (button.dataset.table === selectedTable && !fits) {
      button.classList.remove("selected");
      selectedTable = "";
      document.getElementById("tableId").value = "";
    }
  });
  tableHint.textContent = guests
    ? `${availableCount} pilihan cocok untuk ${guests} orang`
    : "Pilih sesuai kebutuhanmu";
}
guestCount.addEventListener("change", updateTables);

document.getElementById("bookingForm").addEventListener("submit", event => {
  if (!document.getElementById("tableId").value) {
    event.preventDefault();
    formError.textContent = "Silakan pilih salah satu meja terlebih dahulu.";
    document.getElementById("tableOptions").scrollIntoView({behavior: "smooth", block: "center"});
  }
});

tableOptions.forEach(button => {
  button.addEventListener("click", () => {
    if (button.disabled) return;
    tableOptions.forEach(item => item.classList.remove("selected"));
    button.classList.add("selected");
    selectedTable = button.dataset.table;
    document.getElementById("tableId").value = button.dataset.id;
    formError.textContent = "";
  });
});

menuToggle.addEventListener("click", () => navLinks.classList.toggle("open"));
navLinks.querySelectorAll("a").forEach(link => {
  link.addEventListener("click", () => navLinks.classList.remove("open"));
});
updateTables();
