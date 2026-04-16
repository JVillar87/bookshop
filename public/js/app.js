// Initialization functions
window.addEventListener("load", () => {
  addButton.addEventListener("click", saveBook);
  getBooks();
})

// API with server functions
async function getBooks() {
  // COMPLETE CODE
  const res = await fetch("getBooks.php");
  const data = await res.json();
  populateCards(data);
}

async function addBook(book) {
  // COMPLETE CODE
  const res = await fetch("addBook.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(book)
  });

  return await res.json();
}

async function editBook(book) {
  // CODE HERE
  const res = await fetch("editBook.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(book)
  });
  return await res.json();
}

async function deleteBook(id) {
  const payload = new FormData();

  // CODE HERE
  payload.append("id", id);
  await fetch("deleteBook.php", {
    method: "POST",
    body: payload
  });
  getBooks();
}

// DOM management functions
function populateCards(books) {
  const container = document.getElementById("cardsContainer");
  container.innerHTML = "";

  books.forEach(book => {
    const card = document.createElement("div");
    card.className = "card";

    card.innerHTML = `
      <h3>${book.title}</h3>
      <p>${book.author}</p>
      <small>${book.year}</small>
      <button onclick='fillForm(${JSON.stringify(book)})'>Editar</button>
      <button onclick='deleteBook(${book.id})'>Eliminar</button>
    `;

    container.appendChild(card);
  });
}

function fillForm(book) {
  bookId.value = book.id;
  title.value = book.title;
  author.value = book.author;
  year.value = book.year;
}

async function saveBook() {
  const book = {
    id: bookId.value,
    title: title.value,
    author: author.value,
    year: year.value
  };

  if (book.id) {
    await editBook(book);
  } else {
    await addBook(book);
  }

  bookId.value = "";
  title.value = "";
  author.value = "";
  year.value = "";

  getBooks();
}