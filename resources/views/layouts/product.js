$(function () {
    console.log('成功');
    $('.btn_search').on("click", function(){

        
        const searchProductName = $('.search_product_name').val();
        const searchCompanyName = $('.search_company_name').val();

        // $.ajax({       
        //     // POST通信で使用
        //     headers: {
        //         'X-CSRF-TOKEN':$('meta [name = "csrf-token"]').attr('content')
        //     },
        //     type: "post", //HTTP通信の種類
        //     url:'/productlist/search', //通信したいURL
        //     dataType: 'json',
        //     data: {
        //         'searchProductName' : searchProductName,
        //         'searchCompanyName' : searchCompanyName //valはvalue取得
        //     }
        // })

        // // 通信が成功したとき
        // // このときのdataはcontrollerからもらった値（search_product_nameなど）
        // .done((data)=>{
        //     alert('成功');
        // })

        // //通信が失敗したとき
        // .fail((error)=>{
        //     alert('失敗');
        // })
    });
});