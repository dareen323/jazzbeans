<?php

// products========================================================

// fun to get single product
function getSingleProduct($id)
{
    $stmt = connect()->prepare('SELECT * FROM products WHERE id = ?;');
    $stmt->execute(array($id));


    return $stmt->fetch();
}
// print_r(getSingleProduct(1));
// fun to get all products
function getAllProduct()
{
    $stmt = connect()->prepare('SELECT * FROM products ;');
    $stmt->execute();


    return $stmt->fetchAll();
}

// fun to get products from category
function getProductsFromCategory($category_id)
{
    $stmt = connect()->prepare('SELECT * FROM products WHERE category_id = ?;');
    $stmt->execute(array($category_id));


    return $stmt->fetchAll();
}

// fun to get products from that have discount
function getProductsWithDiscount()
{
    $stmt = connect()->prepare('SELECT * FROM products;');
    $stmt->execute();
    $allData =  $stmt->fetchAll();
    $disProducts = [];
    foreach ($allData as $product) {
        if ($product["discount"] and ($product["discount"] == 0 or $product["discount"] != $product["price"])) {

            array_push($disProducts, $product);
        }
    }
    return $disProducts;
}

// fun to get all categories
function getAllCategories()
{
    $stmt = connect()->prepare('SELECT * FROM categories ;');
    $stmt->execute();


    return $stmt->fetchAll();
}

// user ==========================================================================

// fun to get user info
function getUserInfo($id)
{
    $stmt = connect()->prepare('SELECT * FROM users_info WHERE id = ?;');
    $stmt->execute(array($id));


    return $stmt->fetch();
}


// fun to get invoice for user
function getInvoicesForUser($userId)
{
    $stmt = connect()->prepare('SELECT * FROM invoice WHERE user_id = ?;');
    $stmt->execute(array($userId));


    return $stmt->fetchAll();
}
// fun to get all invoices 
function getAllInvoices()
{
    $stmt = connect()->prepare('SELECT * FROM invoice ;');
    $stmt->execute();


    return $stmt->fetchAll();
}
// fun to get invoice details
function getInvoicesDetails($id)
{

    $stmt1 = connect()->prepare('SELECT *
        FROM
            products a
                INNER JOIN
            p_order b
                ON a.id = b.product_id
                INNER JOIN 
            invoice c
                ON b.invoice_id = c.id WHERE c.id = ?;');

    $stmt1->execute(array($id));

    $productsForInvoice = $stmt1->fetchAll();

    return $productsForInvoice;
}
// fun to edit user data by user 
function editUser($id, $name, $address, $phone, $email, $pwd, $dob, $img)
{
    $stmt = connect()->prepare(
        "UPDATE users_info SET name=?, address=?, phone=?, email=?, pwd=?, dob=?, img=?  WHERE id =? ;"
    );
    return  $stmt->execute(array($name, $address, $phone, $email, $pwd, $dob, $img, $id));
}


// admin============================================================================================
// fun to get all users
function getAllUsers()
{
    $stmt = connect()->prepare(
        "SELECT * FROM users_info;"
    );
    $stmt->execute();
    return $stmt->fetchAll();
}
// fun to get one user
function getOneUser($id)
{
    $stmt = connect()->prepare(
        "SELECT * FROM users_info WHERE id = ?;"
    );
    $stmt->execute(array($id));
    $users = $stmt->fetch();
    return $users;
}
// fun to edit user / admin end
function editUserAdmin($id, $name, $address, $phone, $email, $pwd, $dob, $img, $role)
{
    $stmt = connect()->prepare(
        "UPDATE users_info SET name=?, address=?, phone=?, email=?, pwd=?, dob=?, img=?, role=?  WHERE id =? "
    );
    return  $stmt->execute(array($name, $address, $phone, $email, $pwd, $dob, $img, $role, $id));
}
// fun to del any user
function delUser($id)
{
    $stmt = connect()->prepare(
        "DELETE FROM users_info WHERE id = ?;"
    );
    return  $stmt->execute(array($id));
}
// fun to get all categories PS: its in the products section

// fun to create a category
function createCategory($name, $img, $description)
{
    $stmt = connect()->prepare(
        "INSERT INTO categories (name, img, description) VALUES (?,?,?) ;"
    );
    return $stmt->execute(array($name, $img, $description));
}
// fun to edit any category
function editCategory($id, $name, $img, $description)
{
    $stmt = connect()->prepare(
        "UPDATE categories SET name=?, img=?, description=?  WHERE id =? "
    );
    if ($stmt->execute(array($name, $img, $description, $id))) {
        return true;
    } else {
        return false;
    }
}
// fun to del any category
function delCategory($id)
{
    $stmt = connect()->prepare(
        "DELETE FROM categories WHERE id = ?;"
    );
    return   $stmt->execute(array($id));
}
function getCategory($id)
{
    $stmt = connect()->prepare(
        "SELECT * FROM categories WHERE id = ?;"
    );
    $stmt->execute(array($id));
    return   $stmt->fetch();
}
// fun to get all products P.S its in the products section

// fun to create a product 
function createProduct($name, $price, $discount, $category_id, $description, $short_desc, $img, $tags)
{
    $stmt = connect()->prepare(
        "INSERT INTO products (name, price, discount, category_id, description, short_desc, img, tags) VALUES (?,?,?,?,?,?,?,?) ;"
    );
    if ($stmt->execute(array($name, $price, $discount, $category_id, $description, $short_desc, $img, $tags))) {
        return true;
    } else {
        return false;
    }
}
// fun to edit any product
function editProduct($id, $name, $price, $discount, $category_id, $description, $short_desc, $img, $tags, $published)
{
    $stmt = connect()->prepare(
        "UPDATE products SET name=?, price=?, discount=?, category_id=?, description=?, short_desc=?, img=?, tags=?, publish=?   WHERE id =? "
    );
    return $stmt->execute(array($name, $price, $discount, $category_id, $description, $short_desc, $img, $tags, $published, $id));
}
// fun to del any product
function delProduct($id)
{
    $stmt = connect()->prepare(
        "DELETE FROM products WHERE id = ?;"
    );
    return $stmt->execute(array($id));
}
// checkout========

// send To the Product Page for any Product any where just remember to echo its "id" after u run the function 
function sendToProductPage()
{
    echo "http://localhost/jazzbeans/?id=";
}
// print_r(getProductsFromCategory(1)["name"]);
// foreach (getProductsFromCategory(1) as $product) {
//     echo $product["name"] . "<br>";
// }
function addToCartPhp($userId, $productId)
{
    $stmt = connect()->prepare(
        "INSERT INTO cart (user_id, product_id) VALUES (?,?) ;"
    );
    if ($stmt->execute(array($userId, $productId))) {
        return true;
    } else {
        return false;
    }
}

// get cart products 
function getCartForUser($userId)
{
    $stmt = connect()->prepare('SELECT * FROM cart WHERE user_id = ?;');
    $stmt->execute(array($userId));


    return $stmt->fetchAll();
}
function getCartProducts($id)
{

    $stmt1 = connect()->prepare('SELECT *
        FROM
            products a
                INNER JOIN
            cart b
                ON a.id = b.product_id
                 WHERE user_id = ?;');

    $stmt1->execute(array($id));

    $productsForInvoice = $stmt1->fetchAll();

    return $productsForInvoice;
}
function delCartItem($id)
{
    $stmt = connect()->prepare(
        "DELETE FROM cart WHERE id = ?;"
    );
    return   $stmt->execute(array($id));
}
function addInvoice($iNum, $uId, $tP)
{
    $stmt = connect()->prepare(
        "INSERT INTO invoice (invoice_num, user_id, total_price) VALUES (?,?,?) ;"
    );
    return $stmt->execute(array($iNum, $uId, $tP));
}
function getInvoiceByNum($num)
{
    $stmt = connect()->prepare('SELECT * FROM invoice WHERE invoice_num = ?;');
    $stmt->execute(array($num));


    return $stmt->fetch();
}

function addOrder($productId, $iId, $quantity)
{
    $stmt = connect()->prepare(
        "INSERT INTO p_order (product_id, invoice_id, quantity) VALUES (?,?,?) ;"
    );
    return $stmt->execute(array($productId, $iId, $quantity));
}
function emptyCart($u_Id)
{
    $stmt = connect()->prepare(
        "DELETE FROM cart WHERE user_id = ?;"
    );
    return $stmt->execute(array($u_Id));
}


// UPDATE cart SET user_id = 4 WHERE user_id IS NULL;

function assignCart($u_Id)
{
    $stmt = connect()->prepare(
        "UPDATE cart SET user_id = ? WHERE user_id IS NULL;"
    );
    return $stmt->execute(array($u_Id));
}