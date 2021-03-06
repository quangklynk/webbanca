<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>cart</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>resource/css/reset.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>resource/css/cart.css" />

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
    />

    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
      function isInputNumber(evt) {
        var char = String.fromCharCode(evt.which);
        if (!/[0-9]/.test(char)) {
          evt.preventDefault();
        }
      }
      $(document).ready(function () {
        let curren;
        let inside;

        $(".plus-pro").click(function (e) {
          curren = $(this);
          inside = curren.closest(".product-quantity").find(".quantity-input");
          let amount = curren
            .closest(".item-product")
            .find(".product-amount")
            .children();
          let get_price = curren
            .closest(".item-product")
            .find(".product-price")
            .children()
            .text();
          let get_value = $(inside).val();

          get_value++;
          $(amount).text(get_price * get_value);
          $(inside).val(get_value);
          Total();
        });
        $(".subtract-pro").click(function (e) {
          curren = $(this);
          inside = curren.closest(".product-quantity").find(".quantity-input");
          let amount = curren
            .closest(".item-product")
            .find(".product-amount")
            .children();
          let get_price = curren
            .closest(".item-product")
            .find(".product-price")
            .children()
            .text();
          let get_value = $(inside).val();

          if (get_value > 0) {
            get_value--;
            $(amount).text(get_price * get_value);
            $(inside).val(get_value);
            Total();
          }
        });
        $(".delete-pro").click(function (e) {
          curren = $(this);
          inside = curren.closest(".item-product");
          var r = confirm("B???n c?? mu???n x??a ch???!");
          if (r == true) {
            inside.remove();
          }
        });
        $("#check-list-main").click(function (e) {
          if ($(this).is(":checked")) {
            $("input[type=checkbox]").prop("checked", true);
            Total();
          } else {
            $("input[type=checkbox]").prop("checked", false);
            Total();
          }
        });
        $(".ckb-pro").click(function (e) {
          Total();
        });

        function Total() {
          let total_pro = 0;
          let money = 0;
          $(".ckb-pro").each(function (index, value) {
            if ($(this).is(":checked")) {
              total_pro =
                +total_pro +
                +$(this)
                  .closest(".item-product")
                  .find(".product-quantity")
                  .find(".quantity-input")
                  .val();
              money =
                +money +
                +$(this)
                  .closest(".item-product")
                  .find(".product-amount")
                  .find(".product-amount-p")
                  .text();
            }
          });
          $(".all-product span").text(total_pro);
          $(".all-money-product span").text(money);
        }
      });
    </script>
  </head>
  <body>
    <!--[if lt IE 7]>
      <p class="browsehappy">
        You are using an <strong>outdated</strong> browser. Please
        <a href="#">upgrade your browser</a> to improve your experience.
      </p>
    <![endif]-->

    <main>
      <form action="<?= base_url() ?>cart/update/?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
      
      <div class="container-main">
        <div class="left-main">
          <div class="title-cart">
            <div class="check-list">
              <input type="checkbox" name="" id="check-list-main" />
            </div>
            <div class="product-name">
              <label for=""> S???n ph???m </label>
            </div>
            <div class="product-price">
              <p>Gi??</p>
            </div>
            <div class="product-quantity">
              <p>S??? l?????ng</p>
            </div>
            <div class="product-amount">
              <p>S??? ti???n</p>
            </div>
            <div class="action">
              <p>Thao t??c</p>
            </div>
          </div>
          <div class="list-product">
            <?php $total_amount = 0;?>
            <?php foreach ($carts as $value): ?>
              <?php $total_amount = $total_amount + $value['subtotal'];?>
            <div class="item-product">
              <div class="check-list">
                <input type="checkbox" name="" id="" class="ckb-pro" />
              </div>
              <div class="product-name list-name-img">
                <div class="product-img">
                  <img src="imgs/find_user.png" alt="" />
                </div>
                <label for="">
                  <?=$value['name'] ?>
                </label>
              </div>
              <div class="product-price">
                <p><?=$value['price'] ?></p>
              </div>
              <div class="product-quantity">
                <button type="button"  class="plus-pro"><i class="fas fa-plus"></i></button
                ><input
                   type="text"
                  onkeypress="isInputNumber(event)"
                  value="<?php echo $value['qty'];?>"
                  name="qty_<?php echo $value['id']?>"
                  class="quantity-input"
                  readonly="true"
                  size="5"
                />
                <button type="button"  class="subtract-pro">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
              <div class="product-amount">
                <p class="product-amount-p"><?php echo $value['subtotal'];?></p>
              </div>
              <div class="action">
               <a href="<?= base_url() ?>cart/del/<?= $value['id']?>" > <button class="delete-pro" >X??a</button></a>
            </div>
          </div>
          <?php endforeach ?>
          <tr>
              <td colspan="5">
                       T???ng s??? ti???n thanh to??n: <b style="color:red"><?php echo number_format($total_amount)?>??</b>
                       - <a href="<?= base_url() ?>cart/del/?>">X??a to??n b???</a>
                       </td>
            </tr>
        </div>
        <div class="right-main">
          <div class="box-amount-all-pro">
            <div class="all-product">
              <h5>T???ng s???n ph???m:</h5>
              <span>0</span>
            </div>
            <div class="all-money-product">
              <h5>T???m t??nh:</h5>
              <span>0</span>
              <small>??</small>
            </div>
            <button>Mua h??ng</button>
          </div>
        </div>
      </div>
       </form>
    </main>

    <script src="" async defer></script>
  </body>
</html>
