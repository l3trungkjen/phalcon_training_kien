{{ link_to("users/add", "Add User") }}
<br>
{{ get_content() }}
<br>
<table border="1">
    <tr>
        <td>Id</td>
        <td>Username</td>
        <td>Password</td>
        <td>Action</td>
    </tr>
{% for user in users.items %}
    <tr>
        <td>{{ user.id }}</td>
        <td>{{ user.username }}</td>
        <td>{{ user.password }}</td>
        <td>{{ link_to("users/edit/" ~ user.id, "Edit") }} | {{ link_to("users/delete/" ~ user.id, "Delete") }}</td>
    </tr>
{% endfor %}
</table>
{{ link_to("users/", "First") }} 
{{ link_to("users/?page=" ~ users.before, "Previous") }} 
{{ link_to("users/?page=" ~ users.next, "Next") }} 
{{ link_to("users/?page=" ~ users.last, "Last") }} 

You are in page {{ users.current }} of {{ users.total_pages }}