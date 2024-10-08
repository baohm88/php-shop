function confirmDeleteBook(bookId) {
  const userConfirmed = confirm(
    "Are you sure you want to delete the book with ID# " + bookId + "?"
  );

  if (userConfirmed) {
    window.location.href =
      "http://localhost/shop/admin/delete_book/?id=" + bookId;
  }
}

function confirmDeleteAuthor(authorId) {
  const userConfirmed = confirm(
    "Are you sure you want to delete the author with ID# " + authorId + "?"
  );

  if (userConfirmed) {
    window.location.href =
      "http://localhost/shop/admin/delete_author/?id=" + authorId;
  }
}

function confirmDeleteGenre(genreId) {
  const userConfirmed = confirm(
    "Are you sure you want to delete the genre with ID# " + genreId + "?"
  );

  if (userConfirmed) {
    window.location.href =
      "http://localhost/shop/admin/delete_genre/?id=" + genreId;
  }
}

function confirmDeletePublisher(publisherId) {
  const userConfirmed = confirm(
    "Are you sure you want to delete the publisher with ID# " +
      publisherId +
      "?"
  );

  if (userConfirmed) {
    window.location.href =
      "http://localhost/shop/admin/delete_publisher/?id=" + publisherId;
  }
}
