$(document).ready( function () {
    $('.cart_button').click(function (e) {
        addToCart(e)
    })
    $('.cart_button_del').click(function (e) {
        removeFromCart(e)
    })
    $('.cart_button_clear').click(function (e) {
        deleteFromCart(e)

    })
})

function addToCart(e)
{
    let id = e.target.id;
    // let span = $('#span_'+id);
    // let quantity = 0;
    // quantity = parseInt($('.cart_button').val('quantity'));
    // let total_quantity = parseInt($('.totalQuantity').text())
    // parseInt($('.totalQuantity').text(total_quantity))
    // let thisProductQuantity = parseInt(span.text())
    // ++thisProductQuantity

    $.ajax(
        {
            url: '/addToCart/'+id,
            type: "POST",
            data:{
            },
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (data) => {
                updateCart(data)
            }
        })
}
function removeFromCart(e)
{
    let id = e.target.id;

    $.ajax(
        {
            url: '/removeFromCart/'+id,
            type: "POST",
            data:{
            },
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (data) => {
                updateCart(data)

            }
        })
}
function updateCart(data) {
    console.log(data)
    let cartDiv = $('#cartDiv')
    let navCart = $('#navCart')
    let totalQuantity = data.total_quantity
    let removedItem = data.removed_item
    let fullPrice =$('#fullPrice')
    let totalPrice = data.total_price


    navCart.text(totalQuantity)
    fullPrice.text('Total price: ' + Math.floor(totalPrice* 100) / 100)

    if(cartDiv !== undefined){
        if(data.items.length < 1){
            $('#cartDiv > table').remove()
            cartDiv.append('Cart is empty now', document.createElement("p"))
        } else {
            if(removedItem !== undefined){
                $('#tr_'+removedItem).remove()
            }
            console.log(data.items)
            $.each(data.items, (key, item) => updateTableRow(item) )
        }

    }


}
function updateTableRow (item) {
    let tdTotal = $('#td_total_' + item.id)
    let span = $('#span_'+item.id)

    console.log(item)
    tdTotal.text(Math.floor(item.quantity * item.price * 100) / 100 + ' $')

    span.text(item.quantity)

}
