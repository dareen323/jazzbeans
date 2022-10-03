// to disable refresh after anchor click "add to cart"

Anchor.getElementById["Anchor"].addEventListener("click", false);

// fun to get user id and product ad on click "add to cart"

function addToCart(uI, pI) {
  $.ajax({
    type: "POST",
    url: "add_to_cart.php",
    data: { userId: `${uI}`, productId: `${pI}` },
    success: function (html) {
      console.log(html);
      alert("Item added to cart!");
      //   console.log(html);
    },
  });
}
