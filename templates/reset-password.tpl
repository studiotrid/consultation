<main class="wrap" style="display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:100vh;">
  <h1>{t}Reset password{/t}</h1>
  {if isset($message)}
    <h3 class="message {if $status eq 'ok'}success{else}error{/if}" style="margin-top:16px;">{$message}</h3>
  {/if}
  {if $status neq 'error'}
    <form class="card gradient-border" action="reset-password.php" method="post" autocomplete="on">
      <input type="hidden" name="token" value="{$token}">
      <label for="password">{t}New password{/t}</label>
      <input id="password" name="password" class="field" type="password" required placeholder="{t}Enter new password{/t}">
      <div class="gap"></div>
      <div class="actions">
        <button type="submit" class="btn gradient-border">{t}Reset password{/t}</button>
      </div>
    </form>
  {/if}
</main>
