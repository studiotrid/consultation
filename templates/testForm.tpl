<div id="ispit-form{$test.id}" title="{t}The quality of the exam you passed{/t}">
    <form method="POST" action="?upisispita=1">
        <input type="hidden" name="ispitID" id="ispitID" value="{$test.id}"/>
        
        <h4>{t}The quality of the exam you passed for the activation of the{/t} {$test.centar}.  ({t}{$test.planetaen}{/t}) {t}chakra, intensity{/t} {$test.intenzitet}, {$test.datum|date_format:"%A, %d.%m.%Y"}</h4>
        1.	{t}How did you feel during this time period?{/t}<br />
            <label class="radiocheck"><input type="radio" name="odgovor1" value="0"/> {t}poor{/t}</label>
            <label class="radiocheck"><input type="radio" name="odgovor1" value="1"/> 1</label>
            <label class="radiocheck"><input type="radio" name="odgovor1" value="2"/> 2</label>
            <label class="radiocheck"><input type="radio" name="odgovor1" value="3"/> 3</label>
            <label class="radiocheck"><input type="radio" name="odgovor1" value="4"/> 4</label>
            <label class="radiocheck"><input type="radio" name="odgovor1" value="5" checked=""/> 5</label>
            <label class="radiocheck"><input type="radio" name="odgovor1" value="6"/> 6</label>
            <label class="radiocheck"><input type="radio" name="odgovor1" value="7"/> 7</label>
            <label class="radiocheck"><input type="radio" name="odgovor1" value="8"/> 8</label>
            <label class="radiocheck"><input type="radio" name="odgovor1" value="9"/> 9</label>
            <label class="radiocheck"><input type="radio" name="odgovor1" value="10"/> {t}perfect{/t}</label>
            <textarea name="odgovor1text" ></textarea>
        
        2.	{t}What was the objective nature of your behaviour or your reactions?{/t}<br />
            <label class="radiocheck"><input type="radio" name="odgovor2" value="0"/> {t}poor{/t}</label>
            <label class="radiocheck"><input type="radio" name="odgovor2" value="1"/> 1</label>
            <label class="radiocheck"><input type="radio" name="odgovor2" value="2"/> 2</label>
            <label class="radiocheck"><input type="radio" name="odgovor2" value="3"/> 3</label>
            <label class="radiocheck"><input type="radio" name="odgovor2" value="4"/> 4</label>
            <label class="radiocheck"><input type="radio" name="odgovor2" value="5" checked=""/> 5</label>
            <label class="radiocheck"><input type="radio" name="odgovor2" value="6"/> 6</label>
            <label class="radiocheck"><input type="radio" name="odgovor2" value="7"/> 7</label>
            <label class="radiocheck"><input type="radio" name="odgovor2" value="8"/> 8</label>
            <label class="radiocheck"><input type="radio" name="odgovor2" value="9"/> 9</label>
            <label class="radiocheck"><input type="radio" name="odgovor2" value="10"/> {t}perfect{/t}</label>
            <textarea name="odgovor2text" ></textarea>

       3.	{t}What was the real nature of the circumstances today, regarding the events that happened or the people you encountered?{/t}<br />
            <label class="radiocheck"><input type="radio" name="odgovor3" value="0"/> {t}poor{/t}</label>
            <label class="radiocheck"><input type="radio" name="odgovor3" value="1"/> 1</label>
            <label class="radiocheck"><input type="radio" name="odgovor3" value="2"/> 2</label>
            <label class="radiocheck"><input type="radio" name="odgovor3" value="3"/> 3</label>
            <label class="radiocheck"><input type="radio" name="odgovor3" value="4"/> 4</label>
            <label class="radiocheck"><input type="radio" name="odgovor3" value="5" checked=""/> 5</label>
            <label class="radiocheck"><input type="radio" name="odgovor3" value="6"/> 6</label>
            <label class="radiocheck"><input type="radio" name="odgovor3" value="7"/> 7</label>
            <label class="radiocheck"><input type="radio" name="odgovor3" value="8"/> 8</label>
            <label class="radiocheck"><input type="radio" name="odgovor3" value="9"/> 9</label>
            <label class="radiocheck"><input type="radio" name="odgovor3" value="10"/> {t}perfect{/t}</label>
            <textarea name="odgovor3text" ></textarea>
        
            <p class="clearfix" style="clear:both;">
              <button class="btn btn-large btn-warning" type="submit">{t}Save{/t}</button>
              <button class="btn btn-large" type="button" onclick="$('#ispit-form{$test.id}').dialog('close');">{t}Cancel{/t}</button>
              </p>
    </form>
</div>