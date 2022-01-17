<?php
isLoggedIn();
echo "Has iniciado sesión como usuario ", $_SESSION["user"][2] ? "administrador" : "público";