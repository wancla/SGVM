<div class="container">
    <h1>Doação</h1>
    <hr>
    <div class="form-group">
        <form name="add_name" id="add_name">
            <div class="form-inline">  
                <div class="form-group">
                    <label for="cliente">Cliente:</label>
                    <input type="text" class="form-control" id="cliente" name="cliente">
                </div>
                <div class="form-group">
                    <label for="data"></label>
                    <input type="date" class="form-control" id="data" name="data">
                </div>
            </div>
            <br>
            <table class="table table-bordered" id="dynamic_field">
                <tr>
                    <td><input type="text" name="name[]" id="especie" class="form-control name_list"></td>
                    <td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td>
                </tr>
            </table>
            <input type="button" name="submit" id="submit" value="Submit" class="btn btn-warning">
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        var i = 1;
        $('#add').click(function () {
            i++;
            $('#dynamic_field').append('<tr id="row' + i + '"><td><input type="text" name="remove" id="especie" class="form-control name_list"></td><td><button name="remove" id="' + i + '" class="btn btn-danger btn_remove">Remove</button></td></tr>');

        });
        $(document).on('click', '.btn_remove', function () {
            var button_id = $(this).attr("id");
            $("#row" + button_id + "").remove();
        });
        $('#submit').click(function () {
            $.ajax({
                url: "teste",
                method: "POST",
                data: $('#add_name').serialize(),
                success: function (data) {
                    alert(data);
                    $('#add_name')[0].reset();
                }
            });
        });
    });

</script>