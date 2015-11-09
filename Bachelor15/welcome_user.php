
<html>
    <head>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <script>
                $(document).ready(function () {
                    $(".testpick").click(function () {
                        alert("FFS");
                        $(this).closest('tr').find('td').each(function () {
                            var textval = $(this).text(); // this will be the text of each <td>
                            alert(textval);
                        });
                    });
                });

            </script>
    </head>
    <body>
        <table>
            <tr>
                <td>test</td>
                <td>
                    <input type="button" class="testpick">
                </td>
            </tr>
            <tr>
                <td>test2</td>
                <td>jaja</td>
                <td>
                    <input type="button" class="testpick">
                </td>
            </tr>
        </table>
    </body>
</html>

