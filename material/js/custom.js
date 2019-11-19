$(window).on('hashchange', function() {
    if (window.location.hash) {
        var page = window.location.hash.replace('#', '');
        if (page == Number.NaN || page <= 0) {
            return false;
        }else{
            getData(page);
        }
  }
});

// -------------Nhân viên
$('.selectpicker').selectpicker().filter('.with-ajax').ajaxSelectPicker(options);

// ---------------Back Button --------------
function goBack() {
  window.history.back();
}

$(document).ready(function() {
                // $('#dataTables-example').DataTable({
                //         responsive: true
                // });
               
    $('.datepicker').datepicker({
        dateFormat: 'dd-mm-yy',
         icons: {
            date: "fa fa-calendar",
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down",
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-screenshot',
            clear: 'fa fa-trash',
            close: 'fa fa-remove'
        }
    });
    $( ".datepicker" ).datepicker();
    $(document).on('click', '.pagination a',function(event){
        event.preventDefault();

        $('li').removeClass('active');
        $(this).parent('li').addClass('active');

        var myurl = $(this).attr('href');
        // console.log(myurl);
        var page=$(this).attr('href').split('page=')[1];
        // console.log(page);
        getData(page);
    });

    // =============Confirm action=====================
    $(".btn-confirm").on("click", function(e){

        e.preventDefault();

        var url = $(this).attr('href');
        // console.log(url);
        // return;
        var confirm = $(this).attr('confirm');

        $('.modal-body').html('<p>'+confirm+'</p>');
        
        $("#mi-modal").modal('show');
        
    // });

        $(".modal-btn-si").on("click", function(){
            location.href = url;
            // console.log(url);
        });
    });
      // =============Confirm action=====================
    

});

function getData(page){
	$.ajax(
	{
	  url: '?page=' + page,
	  type: "get",
	  datatype: "html",
	  data: {
	    search: $('#search').val(),
	    sort: $('#sort').val(),
	  }
	}).done(function(data){
	// console.log(data);
	  $("#tag_container").empty().html(data);
	  location.hash = page;
	}).fail(function(jqXHR, ajaxOptions, thrownError){
	    alert('No response from server');
	});
}
            

            
// ---------------------------
var options = {
    ajax          : {
        
        url     : '{{ URL::to('search') }}',
        type    : 'get',
        dataType: 'json',
        
        data    : {
          q: '\{\{\{q\}\}\}'
        }
    },
    locale        : {
        emptyTitle: 'Chọn nhân viên'
    },
    log           : 3,
    preprocessData: function (data) {
        var i, l = data.length, array = [];
        if (l) {
            for (i = 0; i < l; i++) {
                array.push($.extend(true, data[i], {
                    text : data[i].name,
                    value: data[i].username,
                    'disabled': false
                }));
            }
        }
        // You must always return a valid array when processing data. The
        // data argument passed is a clone and cannot be modified directly.
        return array;
    },

    preserveSelected: false
};