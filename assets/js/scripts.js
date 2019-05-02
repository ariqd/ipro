function number_format(number, decimals, decPoint, thousandsSep) { // eslint-disable-line camelcase
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
    var n = !isFinite(+number) ? 0 : +number
    var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
    var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
    var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
    var s = ''

    var toFixedFix = function (n, prec) {
        var k = Math.pow(10, prec)
        return '' + (Math.round(n * k) / k)
        .toFixed(prec)
    }

    // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || ''
        s[1] += new Array(prec - s[1].length + 1).join('0')
    }

    return s.join(dec)
}

var classUang = document.getElementsByClassName("printUang");
if (classUang.length > 0) {
    for (var i = 0; i < classUang.length; i++) {
        var val = classUang[i].innerHTML;
        if (val !== '' && val != null && !isNaN(val)) {
            val = parseFloat(classUang[i].innerHTML);
            var res = "Rp. " + number_format(val, 2, ",", ".");
            classUang[i].innerHTML = res;
        }
    }
}

var items_count = 0;

/**
 * Enable / disable PAY button based on items count
 */
 function setButtonState() {
    if (items_count <= 0) {
        $('#btnPay').attr('disabled', 'disabled');
    } else {
        $('#btnPay').removeAttr('disabled');
    }
}

/**
 *  Add searched product to Cart
 *
 * @param id Product Code Part
 */
 function addProduct(id) {
    // console.log("aaa");
    var btn = $('.addProduct-' + id);
    var description = btn.data("description");
    var name = btn.data("name");
    var category = btn.data("category");
    var code = btn.data("code");
    var quantity = btn.data("quantity");
    var price = btn.data("price");
    var finder = $('.select').find('#item-qty-' + code);

    if (finder.length > 0) {
        $('#item-qty-' + code).val(parseInt($('#item-qty-' + code).val()) + 1);
        countSubtotal(code);
    } else {
        $("#items2").append(
            '<div class="card mb-0" id="product-' + code + '">' +
            '   <div class="card-body">' +
            '       <div class="row">' +
            '           <div class="col-lg-6">' +
            '               <h5 class="mb-0"><b>' + name + ' (' + id + ')</b></h5>' +
            '               <p id="price-' + code + '">Rp ' + price + '</p>' +
            '               <input type="hidden" value="' + code + '" name="item[' + items_count + '][stock_id]">' +
            '               <span class="btn btn-outline-danger" onclick="return removeProduct(' + "'" + code + "'" + ');"><i class="fa fa-trash"></i>' +
            '                   Remove' +
            '               </span>' +
            '           </div>' +
            '           <div class="col-lg-6">' +
            '               <div class="pb-2 form-row">' +
            '                   <label for="item-qty-' + code + '"' +
            '                       class="col-sm-4 col-form-label text-right">Qty</label>' +
            '                   <div class="col-sm-8">' +
            '                   <span class="select">' +
            '                       <input type="number" class="form-control item-qty-' + code + '" id="item-qty-' + code + '"' +
            '                              min="1" max="' + quantity + '" value="1" name="item[' + items_count + '][qty]" onchange="countSubtotal(' + "'" + code + "'" + ')">' +
            '                   </span>' +
            '                   </div>' +
            '               </div>' +
            '               <div class="pb-2 form-row">' +
            '                   <label for="item-price-' + code + '"' +
            '                       class="col-sm-4 col-form-label text-right">Price</label>' +
            '                   <div class="col-sm-8">' +
            '                   <span class="select">' +
            '                       <input type="text" readonly class="form-control item-price-' + code + '" id="item-price-' + code + '"' +
            '                              value="' + price + '" name="item[' + items_count + '][price]">' +
            '                   </span>' +
            '                   </div>' +
            '               </div>' +
            '               <div class="pb-2 form-row">' +
            '                   <label for="item-disc-"' +
            '                           class="col-sm-4 col-form-label text-right">Item' +
            '                       Disc</label>' +
            '                   <div class="col-sm-8">' +
            '                       <div class="input-group">' +
            '                           <input type="number" class="form-control item-disc" onchange="countSubtotal(' + "'" + code + "'" + ')"' +
            '                                  id="item-disc-' + code + '"' +
            '                                  min="0" max="100" value="0" step="any" name="item[' + items_count + '][discount]">' +
            '                            <div class="input-group-append">' +
            '                               <span class="input-group-text bg-dark text-light"' +
            '                                   id="customer-name">%</span>' +
            '                            </div>' +
            '                        </div>' +
            '                    </div>' +
            '                </div>' +
            '                <div class="form-row">' +
            '                    <label for="item-total"' +
            '                           class="col-sm-4 col-form-label text-right">Subtotal</label>' +
            '                    <div class="col-sm-8">' +
            '                       <div class="input-group">' +
            '                            <div class="input-group-prepend">' +
            '                               <span class="input-group-text bg-dark text-light"' +
            '                                      id="rp">Rp' +
            '                               </span>' +
            '                            </div>' +
            '                            <input type="text" class="form-control subtotal" value="' + price + '"' +
            '                                   id="item-subtotal-' + code + '"' +
            '                                   readonly name="item[' + items_count + '][total]">' +
            '                       </div>' +
            '                   </div>' +
            '               </div>' +
            '           </div>' +
            '       </div>' +
            '   </div>' +
            '</div>'
            );

items_count++;
setButtonState();
countTotal();
$('.count').text(items_count + " barang dalam keranjang");

}
}

/**
 * Remove product from cart
 *
 * @param product_code Product Code Part
 */
 function removeProduct(product_code) {
    $("#product-" + product_code).remove();
    items_count--;
    setButtonState();
    countTotal();
    if (items_count === 0) {
        $('.count').text("Belum ada barang dipilih");
    } else {
        $('.count').text(items_count + " barang dalam keranjang");
    }
}

/**
 * Count each product's subtotal every time quantity or discount changed
 *
 * @param product_code Product Code Part
 */
 function countSubtotal(product_code) {
    var actual_price = parseFloat($('#price-' + product_code).text().replace('Rp ', '') || 0);
    var qty = parseFloat($("#item-qty-" + product_code).val()) || 0;
    var discount = parseFloat($("#item-disc-" + product_code).val() || 0)

    if ($("#item-qty-" + product_code).val() === "") {
        swal({
            text: "Qty for item #" + product_code + " cannot be empty!",
            icon: "error",
        });
        $("#grand-total-span").html("Rp 0,-");
        $('#btnPay').attr('disabled', 'disabled');
    } else {
        $('#btnPay').removeAttr('disabled');
    }

    if ($("#item-disc-" + product_code).val() === "") {
        swal({
            text: "Please enter an amount for item discount (at least 0)",
            icon: "error",
        });
        $('#btnPay').attr('disabled', 'disabled');
    } else {
        $('#btnPay').removeAttr('disabled');
    }

    var subtotal = parseFloat((actual_price * qty) || 0);
    var subtotal_after = parseFloat(subtotal - (subtotal * discount / 100) || 0);

    $("#item-subtotal-" + product_code).val(subtotal_after);
    countTotal();
}

/**
 * Count grand total based on subtotals
 */
 function countTotal() {
    var all_subtotals_length = $('.subtotal').length;
    var grand_subtotal = 0;

    for (i = 0; i < all_subtotals_length; i++) {
        grand_subtotal = grand_subtotal + (parseFloat($('.subtotal:eq(' + i + ')').val() || 0));
    }

    var discount = parseFloat($("#discount").val() || 0);

    discount = discount / 100 * grand_subtotal;
    var down_payment = $("#dp").val();

    if (down_payment >= grand_subtotal) {
        if (!$('#dp').prop('disabled') && items_count > 0) {
            swal({
                text: "Please check your Down Payment!",
                icon: "error"
            });
            $("#dp").val(0);
            $("#dp").focus();
        }
    } else {
        var grand_total = grand_subtotal - discount - down_payment;

        $("#subtotal").val(grand_subtotal);
        $("#grand-total-span").html("Rp " + number_format(grand_subtotal) + ",-");
        $("#grand-total-input").val(grand_total);
    }
}

function print(name) {
    printJS(name);
}

