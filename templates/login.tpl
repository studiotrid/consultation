  
  <main class="wrap">
    <form class="card gradient-border" action="#" method="post" autocomplete="on">
      <h1>{t}Consultation{/t}</h1>
      {if isset($message)}<h3 class="message {if $status eq 'ok'}success{else}error{/if}">{$message}</h3>{/if}
      <label for="username">{t}Username{/t}</label>
      <input id="username" name="username" class="field" type="text" required placeholder="{t}Enter your username{/t}">

      <div class="gap"></div>

      <label for="password">{t}Password{/t}</label>
      <input id="password" name="password" class="field" type="password" required placeholder="{t}Enter your password{/t}">

      <div class="gap"></div>

      <div class="actions">
        <div class="small">&nbsp;</div>
        <button type="submit" class="btn gradient-border">{t}Log in{/t}</button>
      </div>
    </form>
  </main>