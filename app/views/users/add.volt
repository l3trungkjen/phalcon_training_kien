{{ form("users/save", "method":"post") }}
<table width="100%">
    <tr>
        <td align="left">
            {{ link_to("users", "Go Back") }}
        </td>
    </tr>
</table>
{{ get_content() }}
<div align="center">
    <h1>Create Users</h1>
</div>

<table align="center">
    <tr>
        <td align="right">
            <label for="name">Username</label>
        </td>
        <td align="left">
            {{ text_field("username", "size":30, "placeholder": "Enter a username") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="type">Password</label>
        </td>
        <td align="left">
            {{ password_field("password", "size":30, "placeholder": "Enter a password") }}
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            {{ submit_button("Save") }}
        </td>
    </tr>
</table>
{{ endform() }}