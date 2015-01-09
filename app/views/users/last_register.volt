{{ link_to("../users/add", "Add User") }}
<br>
{{ get_content() }}
<br>
<table border="1">
    <tr>
        <td>#</td>
        <td>Username</td>
    </tr>
    {% for key, user in users %}
    <tr>
        <td>{{ user.id }}</td>
        <td>{{ user.username }}</td>
    </tr>
    {% endfor %}
</table>