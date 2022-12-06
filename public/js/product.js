// moreはrouteつきにしたい（routeの指定方法）

// $(function () {

    // 検索
    $('#btn_search').on("click", function(){
        // console.log("----search_func_start----");

        const searchProductName = $('#searchProductName').val();
        const searchCompanyName = $('#searchCompanyName').val();
        const searchLowerPrice = $('#searchLowerPrice').val();
        const searchUpperPrice = $('#searchUpperPrice').val();
        const searchLowerStock = $('#searchLowerStock').val();
        const searchUpperStock = $('#searchUpperStock').val();

        // console.log("商品名:"+searchProductName);
        // console.log("社名:"+searchCompanyName);
        // console.log("下限:"+searchLowerPrice);
        // console.log("上限:"+searchUpperPrice);

        // console.log("----ajax_start----");

        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //     }
        // });

        $.ajax({       
            headers: {　// POST通信で使用
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'productlist/search', //通信したいURL
            type: 'POST', //HTTP通信の種類
            data:JSON.stringify({　//送りたい変数記述
                searchProductName : searchProductName,
                searchCompanyName : searchCompanyName,
                searchLowerPrice : searchLowerPrice,
                searchUpperPrice : searchUpperPrice,
                searchLowerStock : searchLowerStock,
                searchUpperStock : searchUpperStock
            }),
            datatype:"text",
            contentType: "application/json"
        })

        // このときのdataはcontrollerからもらった値（search_product_nameなど）
        // .done((data)=>{
        .done(function(data){
            console.log(data);
            console.log('done');

            $('tbody').remove(); //全リスト削除
            $('table').append('<tbody>');

            $.each(data, function(index, val) {
                console.log(index+",");
                $('tbody').append('<tr id=' + val.product_id + '>');

                $('#' + val.product_id).append('<td>'+ val.product_id + '</td>');
                $('#' + val.product_id).append('<td>'+ val.img_path + '</td>');
                $('#' + val.product_id).append('<td>'+ val.product_name + '</td>');
                $('#' + val.product_id).append('<td>'+ val.price + '</td>');
                $('#' + val.product_id).append('<td>'+ val.stock + '</td>');
                $('#' + val.product_id).append('<td>'+ val.company_name + '</td>');
                $('#' + val.product_id).append('<td><button type="button" id="btn_more">more</button></td>');
                $('#' + val.product_id).append('<td><button type="button" value="' +  val.product_id + '"class="btn_delete">削除</button></td>');
                // $(document).on('change', '.btn_delete', function(){
                //     let val = val.product_id
                //     $('.btn_delete').val(val);
                // });
                //value=' + val.product_id + 削除
                $('#val.product_id').append('<br>');
            })
        })

        .fail((jqXHR, textStatus, errorThrown)=>{
            console.log('fail');
            console.log('error:'+e);
            console.log("jqXHR          : " + jqXHR.status); // HTTPステータスが取得
            console.log("textStatus     : " + textStatus);    // タイムアウト、パースエラー
            console.log("errorThrown    : " + errorThrown.message); // 例外情報
        })
    });

    // ソート
    let i = 1;
    $('.col_sort').on('click', function(){
        console.log("----sort_func_start----");

        let colSort = $(this).val();
        let hidA = $('#hidA').val();
        let hidC = $('#hidC').val();
        
        i++;

        // 検索の部分もいれる
        const searchProductName = $('#searchProductName').val();
        const searchCompanyName = $('#searchCompanyName').val();
        const searchLowerPrice = $('#searchLowerPrice').val();
        const searchUpperPrice = $('#searchUpperPrice').val();
        const searchLowerStock = $('#searchLowerStock').val();
        const searchUpperStock = $('#searchUpperStock').val();

        console.log(colSort);
        console.log(i);
        console.log(hidC);

        if (colSort == hidC) {
            if (i % 2 ==0) {
                hidA = 'desc';
            } else {
                hidA = 'asc';
            }
        } else {
            
            hidC = colSort;
            if (i % 2 == 0) {
                hidA = 'desc';
            } else {
                hidA = 'asc';
            }
        }

        console.log('変更後：' + colSort);
        console.log('変更後：' + hidA);
        console.log('変更後：' + hidC);

        console.log("----ajax_start----");

        $.ajax({
            headers: {　// POST通信で使用
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'productlist/sort', //通信したいURL
            type: 'POST', //HTTP通信の種類
            data:JSON.stringify({
                colSort : colSort,
                hidA : hidA,
                hidC : hidC,
                searchProductName : searchProductName,
                searchCompanyName : searchCompanyName,
                searchLowerPrice : searchLowerPrice,
                searchUpperPrice : searchUpperPrice,
                searchLowerStock : searchLowerStock,
                searchUpperStock : searchUpperStock
            }),
            datatype:"text",
            contentType: "application/json"
        })

        .done(function(data){
            console.log(data);
            console.log('並べ替え成功');
            
            // 検索の部分も入れる
            $('tbody').remove(); //全リスト削除
            $('table').append('<tbody>');

            $.each(data, function(index, val) {
                console.log(index+",");
                $('tbody').append('<tr id=' + val.product_id + '>');

                $('#' + val.product_id).append('<td>'+ val.product_id + '</td>');
                $('#' + val.product_id).append('<td>'+ val.img_path + '</td>');
                $('#' + val.product_id).append('<td>'+ val.product_name + '</td>');
                $('#' + val.product_id).append('<td>'+ val.price + '</td>');
                $('#' + val.product_id).append('<td>'+ val.stock + '</td>');
                $('#' + val.product_id).append('<td>'+ val.company_name + '</td>');
                $('#' + val.product_id).append('<td><button type="button" id="btn_more">more</button></td>');
                $('#' + val.product_id).append('<td><button type="button" value="' +  val.product_id + '"class="btn_delete">削除</button></td>');
                // $(document).on('change', '.btn_delete', function(){
                //     let val = val.product_id
                //     $('.btn_delete').val(val);
                // });
                //value=' + val.product_id + 削除
                $('#val.product_id').append('<br>');
            })
        })

        .fail(function(){
            console.log('並べ替え失敗');
        })
    });

    // 削除
    $(document).on('click', '.btn_delete', function(){
        console.log("----delete_func_start----");
        const id = $('.btn_delete').val();

        console.log(id);
        console.log("----ajax_start----");

        $.ajax({
            url:'productlist/delete/' + id, //通信したいURL
            type: 'GET', //HTTP通信の種類
            data:JSON.stringify({
                id : id
            }),
            datatype:"text",
            contentType: "application/json"
        })
        .done(function(data){
            console.log(data);
            console.log('削除成功');
            
            // 検索の部分も入れる
            $('tbody').remove(); //全リスト削除
            $('table').append('<tbody>');

            $.each(data, function(index, val) {
                console.log(index+",");
                $('tbody').append('<tr id=' + val.product_id + '>');

                $('#' + val.product_id).append('<td>'+ val.product_id + '</td>');
                $('#' + val.product_id).append('<td>'+ val.img_path + '</td>');
                $('#' + val.product_id).append('<td>'+ val.product_name + '</td>');
                $('#' + val.product_id).append('<td>'+ val.price + '</td>');
                $('#' + val.product_id).append('<td>'+ val.stock + '</td>');
                $('#' + val.product_id).append('<td>'+ val.company_name + '</td>');
                $('#' + val.product_id).append('<td><button type="button" id="btn_more">more</button></td>');
                $('#' + val.product_id).append('<td><button type="button" value="' +  val.product_id + '"class="btn_delete">削除</button></td>');
                // $(document).on('change', '.btn_delete', function(){
                //     let val = val.product_id
                //     $('.btn_delete').val(val);
                // });
                //value=' + val.product_id + 削除
                $('#val.product_id').append('<br>');
            })
        })

        .fail(function(){
            console.log('削除失敗');
        })
    })

// });
