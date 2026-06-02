<main class="wrap">
  <form class="card gradient-border" action="forgot-password.php" method="post" autocomplete="on">
    <h1>{t}Forgot your password?{/t}</h1>
    {if isset($message)}<h3 class="message {if $status eq 'ok'}success{else}error{/if}">{$message}</h3>{/if}
    <label for="email">{t}Email{/t}</label>
    <input id="email" name="email" class="field" type="email" required placeholder="{t}Enter your email{/t}">
    <div class="gap"></div>
    <div class="actions">
      <button type="submit" class="btn gradient-border">{t}Send reset link{/t}</button>
    </div>
  </form>
</main>
