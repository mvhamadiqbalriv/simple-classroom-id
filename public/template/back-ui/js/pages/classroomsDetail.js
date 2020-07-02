
        // Change the selector if needed
        var $table = $('.table-fixed'),
        $bodyCells = $table.find('tbody tr:first').children(),
        colWidth;
        
        // Adjust the width of thead cells when window resizes
        $(window).resize(function() {
        // Get the tbody columns width array
        colWidth = $bodyCells.map(function() {
        return $(this).width();
        }).get();
        
        // Set the width of thead columns
        $table.find('thead tr').children().each(function(i, v) {
        $(v).width(colWidth[i]);
        });
        }).resize(); // Trigger resize handler

        $(document).ready(function () {
            $('.lihatMateri').click(function(){
                $('#detailMateri').modal('show');
                $('#file_materi_detail').attr("download", "")
                var theory_id = $(this).attr("id");
                var lihatMateri = true;

                $.ajax({
                    url : window.location.href ,
                    method : 'POST',
                    data : {
                        "theory_id":theory_id, 
                        "lihatMateri":lihatMateri,
                        "_token": $('meta[name="_token"]').attr('content')
                    },
                    success : function(data){
                        var result = JSON.parse(data);
                        $('#judul_materi_detail').html(result.judul);
                        $('#deskripsi_materi_detail').html(result.deskripsi);
                        if (result.file_name === null) {
                            $('#file_materi_detail').html("Tidak ada file");
                            $('#file_materi_detail').removeAttr('download');
                            $('#file_materi_detail').attr('href', '#');
                            $('#file_materi_detail').css('color', 'grey');
                        }else{
                            $('#file_materi_detail').html(result.file_name);
                            $('#file_materi_detail').css('color', 'blue');
                            $('#file_materi_detail').attr('href', window.location.origin + '/storage/' + result.file);
                        }
                    }
                })
            })
            $('.ubahMateri').click(function(){
                $('#modalFileName').attr("download", "")
                var theory_id = $(this).attr("id");
                var ubahMateri = true;

                $.ajax({
                    url : window.location.href ,
                    method : 'POST',
                    data : {
                        "theory_id":theory_id, 
                        "ubahMateri":ubahMateri,
                        "_token": $('meta[name="_token"]').attr('content')
                     },
                    success : function(data){
                        var result = JSON.parse(data);
                        $('#theory_id').val(result.id);
                        $('#judul_materi').val(result.judul);
                        $('#deskripsi_materi').html(result.deskripsi);
                        if (result.file_name === null) {
                            $('#modalFileName').html("Belum ada file");
                            $('#modalFileName').removeAttr('download');
                            $('#modalFileName').attr('href', '#');
                            $('#modalFileName').css('color', 'grey');
                        }else{
                            $('#modalFileName').html(result.file_name);
                            $('#modalFileName').css('color', 'blue');
                            $('#modalFileName').attr('href', window.location.origin + '/storage/' + result.file);
                        }
                    }
                })
            })
        })  