<!DOCTYPE html>

<html>

    <head>
        <title>Mini-chat</title>
        <meta charset="utf-8" />
    </head>

    <body>

        <form action="chat.php" method="post">
        <p>
            <input type="text" name="pseudo" />
            <textarea name = "message" rows = "8" cols = "45"/>
            <input type="submit" value="Envoyer" />
        </p>
        </form>

        <div id="messagesChat">
        </div>

    </body>
</html>