function confirmDeleteBook(bookId) {
  const userConfirmed = confirm(
    "Are you sure you want to delete the book with ID# " + bookId + "?"
  );

  if (userConfirmed) {
    window.location.href = "http://localhost/shop/admin/delete/?id=" + bookId;
  }
}
