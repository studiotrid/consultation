<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    background: #f5f5f5;
}

h1 {
    text-align: center;
    color: #333;
    margin-bottom: 10px;
}

.test-info {
    text-align: center;
    color: #666;
    margin-bottom: 30px;
    font-size: 18px;
}

.success-message {
    background: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
    padding: 20px;
    border-radius: 5px;
    text-align: center;
    margin: 20px 0;
}

.instruction {
    background: #fff3cd;
    border: 1px solid #ffc107;
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 20px;
    text-align: center;
    font-weight: bold;
}

ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

li {
    background: white;
    border: 1px solid #ddd;
    margin: 15px 0;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

li h3 {
    margin: 0 0 20px 0;
    color: #333;
    font-size: 16px;
}

.slider-container {
    padding: 10px 20px;
}

.slider-wrapper {
    position: relative;
    padding: 20px 0;
}

.custom-slider {
    width: 100%;
}

.slider-labels {
    display: flex;
    justify-content: space-between;
    margin-top: 10px;
    font-size: 12px;
    color: #666;
}

.slider-value {
    text-align: center;
    font-size: 24px;
    font-weight: bold;
    color: #5f95c9;
    margin-bottom: 10px;
}

.ui-slider-horizontal {
    height: 12px;
    border-radius: 6px;
    background: #e0e0e0;
    border: none;
}

.ui-slider .ui-slider-handle {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #5f95c9;
    border: 3px solid white;
    box-shadow: 0 2px 5px rgba(0,0,0,0.3);
    cursor: pointer;
    top: -8px;
}

.ui-slider .ui-slider-handle:hover {
    background: #4a7ba7;
}

.ui-slider .ui-slider-range {
    background: #5f95c9;
    border-radius: 6px;
}

.submit-btn {
    display: block;
    width: 200px;
    margin: 30px auto;
    padding: 15px 30px;
    background: #5f95c9;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.submit-btn:hover {
    background: #4a7ba7;
}

.close-btn {
    display: block;
    width: 150px;
    margin: 20px auto;
    padding: 10px 20px;
    background: #6c757d;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    text-decoration: none;
    text-align: center;
}

.close-btn:hover {
    background: #5a6268;
}
</style>
</head>
<body>

{if isset($success)}
    <div class="success-message">
        <h2>✓ Odgovori su uspešno sačuvani!</h2>
        <p>Hvala vam što ste završili test.</p>
        <button class="close-btn" onclick="window.parent.$('.ui-dialog-content').dialog('close'); window.parent.location.reload();">Zatvori</button>
    </div>
{elseif isset($test)}
    <h1>Tehnologija Svesti - Test</h1>
    <div class="test-info">{$test.nazivPlanete}</div>
    
    <form method="post" action="tsTestPolaganje.php" id="tsTestForm">
        <input type="hidden" name="testID" value="{$test.id}"/>
        
        <div class="instruction">
            Označite na skali od 0 do 10 one odgovore koji su za vas trenutno tačni<br>
            ili su tačni u najvećem broju slučajeva.
        </div>
        
        <ul>
        {foreach from=$pitanja item=pitanje name=broj}
            <li>
                <h3>{$smarty.foreach.broj.iteration}. {$pitanje.tekst}</h3>
                <div class="slider-container">
                    <div class="slider-value" id="value_{$pitanje.id}">5</div>
                    <div class="slider-wrapper">
                        <div class="custom-slider" id="slider_{$pitanje.id}"></div>
                        <input type="hidden" name="odgovori[{$pitanje.id}]" id="answer_{$pitanje.id}" value="5">
                    </div>
                    <div class="slider-labels">
                        <span>0</span>
                        <span>1</span>
                        <span>2</span>
                        <span>3</span>
                        <span>4</span>
                        <span>5</span>
                        <span>6</span>
                        <span>7</span>
                        <span>8</span>
                        <span>9</span>
                        <span>10</span>
                    </div>
                </div>
            </li>
        {/foreach}
        </ul>
        
        {if $test.tip eq 'posttest'}
        <h2 style="text-align:center; color: #5f95c9; margin-top: 40px; margin-bottom: 30px;">Dodatna pitanja</h2>
        <ul>
            <li>
                <h3>31. Koliko ste praktikovali vežbu za balansiranje izazovnog odnosa u proteklih mesec dana?</h3>
                <div style="padding: 10px 0;">
                    <label style="display: block; margin: 10px 0; cursor: pointer;">
                        <input type="radio" name="post1" value="Manje od 7 dana" style="margin-right: 10px;"/> Manje od 7 dana
                    </label>
                    <label style="display: block; margin: 10px 0; cursor: pointer;">
                        <input type="radio" name="post1" value="Dve nedelje" style="margin-right: 10px;"/> Dve nedelje
                    </label>
                    <label style="display: block; margin: 10px 0; cursor: pointer;">
                        <input type="radio" name="post1" value="Više od dve nedelje" style="margin-right: 10px;"/> Više od dve nedelje
                    </label>
                    <label style="display: block; margin: 10px 0; cursor: pointer;">
                        <input type="radio" name="post1" value="Svih 28 dana" style="margin-right: 10px;"/> Svih 28 dana
                    </label>
                </div>
            </li>
            
            <li>
                <h3>32. Ocenite stanje sopstvene odmornosti u ovom trenutku nakon ovih mesec dana na skali od 1 do 10 (1 je najmanji stepen odmora, a 10 najveći):</h3>
                <div style="padding: 15px 0;">
                    <div style="margin: 15px 0;">
                        <label style="display: block; margin-bottom: 5px; font-weight: bold;">a. Mentalni odmor</label>
                        <input type="number" name="post2a" min="1" max="10" step="1" style="width: 100px; padding: 8px; font-size: 16px; border: 1px solid #ddd; border-radius: 5px;"/>
                    </div>
                    <div style="margin: 15px 0;">
                        <label style="display: block; margin-bottom: 5px; font-weight: bold;">b. Fizički odmor</label>
                        <input type="number" name="post2b" min="1" max="10" step="1" style="width: 100px; padding: 8px; font-size: 16px; border: 1px solid #ddd; border-radius: 5px;"/>
                    </div>
                    <div style="margin: 15px 0;">
                        <label style="display: block; margin-bottom: 5px; font-weight: bold;">c. Emotivni odmor</label>
                        <input type="number" name="post2c" min="1" max="10" step="1" style="width: 100px; padding: 8px; font-size: 16px; border: 1px solid #ddd; border-radius: 5px;"/>
                    </div>
                </div>
            </li>
            
            <li>
                <h3>33. Opišite uvide koje ste imali praktikujući datu vežbu.</h3>
                <textarea name="post3" style="width: 100%; height: 120px; padding: 10px; font-size: 14px; border: 1px solid #ddd; border-radius: 5px; resize: vertical; font-family: Arial, sans-serif;"></textarea>
            </li>
            
            <li>
                <h3>34. Na kom životnom planu ste primetili najviše promena? Opišite na koji način ste uspeli da transformišete određeni izazovni odnos?</h3>
                <textarea name="post4" style="width: 100%; height: 120px; padding: 10px; font-size: 14px; border: 1px solid #ddd; border-radius: 5px; resize: vertical; font-family: Arial, sans-serif;"></textarea>
            </li>
        </ul>
        {/if}
        
        <button type="submit" class="submit-btn">Sačuvaj odgovore</button>
    </form>
    
    <script>
    $(document).ready(function() {
        {foreach from=$pitanja item=pitanje}
        $("#slider_{$pitanje.id}").slider({
            min: 0,
            max: 10,
            value: 5,
            range: "min",
            slide: function(event, ui) {
                $("#value_{$pitanje.id}").text(ui.value);
                $("#answer_{$pitanje.id}").val(ui.value);
            }
        });
        {/foreach}
    });
    </script>
{else}
    <div class="success-message" style="background: #f8d7da; border-color: #f5c6cb; color: #721c24;">
        <h2>Test nije pronađen ili je već urađen</h2>
        <button class="close-btn" onclick="window.parent.$('.ui-dialog-content').dialog('close');">Zatvori</button>
    </div>
{/if}

</body>
</html>
