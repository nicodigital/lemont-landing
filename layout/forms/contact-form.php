<?php
$lang = $GLOBALS["lang"];
?>

<form id="sheetdb-form" class="form" action="" method="POST" accept-charset="utf-8">

    <input type="checkbox" name="_honeypot" style="display:none" tabindex="-1" autocomplete="off" />
    <input type="hidden" name="_email.template.footer" value="false" />

    <input type="hidden" name="lang" value="<?= $GLOBALS['lang']  ?>" />

    <div class="field">
        <input type="text" name="name" placeholder="Nombre" pattern="^[A-Za-z]+ [A-Za-z]+$" required autocomplete="off" />
        <div class="valid-msg">Debes colocar tu nombre y apellido</div>
    </div>

    <div class="grid xg:grid-cols-2 gap-1 md:gap-2 ">
        <div class="field">
            <input type="email" name="email" placeholder="ejemplo@email.com" required autocomplete="off" />
            <div class="valid-msg">Debes colocar un correo válido</div>
        </div>

        <div class="field">
            <input type="tel" name="phone" placeholder="Teléfono" required minlength="9" maxlength="18" autocomplete="off" />
            <div class="valid-msg">Debes colocar un teléfono válido</div>
        </div>
    </div>

    <!-- Tipo de propiedad -->
    <div class="field">
        <div class="title">Tipo de propiedad</div>
        <div class="grid grid-cols-2 xg:grid-cols-3 ">
            <label class="checkbox" for="1hab">
                <input type="radio" id="1hab" name="property_type" value="1 Habitación">
                <span class="checkmark"></span> <span class="txt">1 Habitación</span>
            </label>
            <label class="checkbox" for="2hab">
                <input type="radio" id="2hab" name="property_type" value="2 Habitaciones">
                <span class="checkmark"></span> <span class="txt">2 Habitaciones</span>
            </label>
            <label class="checkbox" for="3hab">
                <input type="radio" id="3hab" name="property_type" value="3 Habitaciones">
                <span class="checkmark"></span> <span class="txt">3 Habitaciones</span>
            </label>
            <label class="checkbox" for="SemiPiso">
                <input type="radio" id="SemiPiso" name="property_type" value="SemiPiso">
                <span class="checkmark"></span> <span class="txt">Semi-Piso</span>
            </label>
            <label class="checkbox" for="Piso">
                <input type="radio" id="Piso" name="property_type" value="Piso">
                <span class="checkmark"></span> <span class="txt">Piso</span>
            </label>
            <label class="checkbox" for="Penthouse">
                <input type="radio" id="Penthouse" name="property_type" value="Penthouse">
                <span class="checkmark"></span> <span class="txt">Penthouse</span>
            </label>
        </div>
    </div>

    <!-- Rango de precio -->
    <div class="field">
        <div class="title"> Rango de precio </div>
        <div class="grid grid-cols-2 xg:grid-cols-4 ">

            <label class="checkbox" for="h250">
                <input type="radio" id="h250" name="price_range" value="hasta $250 mil">
                <span class="checkmark"></span> <span class="txt"> hasta $250 mil </span>
            </label>

            <label class="checkbox" for="h500">
                <input type="radio" id="h500" name="price_range" value="hasta $500 mil">
                <span class="checkmark"></span> <span class="txt"> hasta $500 mil </span>
            </label>

            <label class="checkbox" for="h1m">
                <input type="radio" id="h1m" name="price_range" value="hasta 1 M">
                <span class="checkmark"></span> <span class="txt"> hasta 1 M </span>
            </label>

            <label class="checkbox" for="m1m">
                <input type="radio" id="m1m" name="price_range" value="mas 1 M">
                <span class="checkmark"></span> <span class="txt"> mas 1 M </span>
            </label>

        </div>
    </div>

    <div class="select">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="m5.84 9.59l5.66 5.66l5.66-5.66l-.71-.7l-4.95 4.95l-4.95-4.95z"/></svg>
        <select name="contact_preference" id="contact-preference">
            <option value="Como">
                ¿Cómo prefiere que lo contactemos?
            </option>
            <option value="Email">Email</option>
            <option value="Telefono">Telefono</option>
            <option value="Texto">Texto</option>
        </select>
    </div>

    <div class="select">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="m5.84 9.59l5.66 5.66l5.66-5.66l-.71-.7l-4.95 4.95l-4.95-4.95z"/></svg>
        <select name="contact-preference" id="contact-preference">
            <option value="Como">
                ¿Cómo se enteró de LEMONT?
            </option>
            <option value="Publicidad">Publicidad</option>
            <option value="Broker">Broker</option>
            <option value="Online">Online</option>
            <option value="Referido">Referido</option>
            <option value="Valla de Obra">Valla de Obra</option>
            <option value="Redes Sociales">Redes Sociales</option>
            <option value="Otros">Otros</option>
        </select>
    </div>

    <div class="field">
        <textarea name="message" placeholder="Hay alguna información adicional que le gustaría compratir sobre su búsqueda?" minlength="16" rows="1" cols="50"></textarea>
        <div class="valid-msg">Tu mensaje debe ser de mas de 16 caracteres.</div>
    </div>

    <div class="flex items-center gap-2 md:gap-4 mt-2 xg:mt-8">

        <button type="submit" class="btn outline rounded-xl" disabled>
            <span class="flex align-center">
                <span class="loader mr-1"></span>
                <span class="txt flex gap-1">
                    Enviar
                </span>
            </span>
        </button>

        <!-- <div class="g-recaptcha" data-sitekey="<?php // echo $GLOBALS['recaptcha_key'] 
                                                    ?>"></div> -->

        <div id="result"></div>
        

    </div>

</form>