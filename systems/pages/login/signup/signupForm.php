<?php  if(!isset($_SESSION['user_id'])){ ?>
    
    <form action="signup/signup.inc.php" method="post">
    <div class="form-content">
        <h3 class="title">Sign up</h3>
        <div class="flex">
            <input type="text" name="vorname" id=""  placeholder="Vorname">
            <input type="text" name="nachname" id=""  placeholder="Nachname">
        </div>
        

        <input type="text" name="username" placeholder="Nutzername">
        <input type="email" name="email" placeholder="Email Adresse">
        <input type="password" name="password" placeholder="Passwort">
        
        <input type="text" name="street" id=""  placeholder="Adresse">
        <div class="flex">
            <input type="number" name="plz" id=""  placeholder="PLZ">
            <input type="text" name="ort" placeholder="Ort">
        </div>
        <button>Sign up</button>
    </div>

    </form>
<?php } ?>