# Podešavanje SSH sa Windows računara

## Korak 1: Otvorite PowerShell ili Git Bash na Windows-u

Desni klik na Start → Windows PowerShell ili Git Bash

## Korak 2: Izvršite sledeće komande

```bash
# Generišite SSH ključ (pritisnite Enter za sve)
ssh-keygen -t rsa -b 4096 -C "admin@profesionalnaastrologija.com"

# Kopirajte javni ključ na server (unesite šifru samo ovaj poslednji put)
type $env:USERPROFILE\.ssh\id_rsa.pub | ssh admin@91.98.132.227 "mkdir -p ~/.ssh && cat >> ~/.ssh/authorized_keys"

# Za Git Bash koristite:
# cat ~/.ssh/id_rsa.pub | ssh admin@91.98.132.227 "mkdir -p ~/.ssh && cat >> ~/.ssh/authorized_keys"

# Testirajte konekciju (ne bi trebalo da traži šifru)
ssh admin@91.98.132.227 "echo 'SSH radi bez šifre!'"
```

## Korak 3: Kreirajte SSH config fajl na Windows-u

```bash
# PowerShell:
New-Item -ItemType Directory -Force -Path $env:USERPROFILE\.ssh
notepad $env:USERPROFILE\.ssh\config

# Git Bash:
mkdir -p ~/.ssh
nano ~/.ssh/config
```

Dodajte sledeći sadržaj:

```
Host consultation-prod
    HostName 91.98.132.227
    User admin
    IdentityFile ~/.ssh/id_rsa
    ServerAliveInterval 60
    ServerAliveCountMax 3
```

Sačuvajte fajl (Ctrl+S u Notepad, ili Ctrl+X, Y, Enter u nano)

## Korak 4: Testirajte u VS Code

1. Pritisnite `Ctrl+Shift+P`
2. Ukucajte: `Remote-SSH: Connect to Host`
3. Izaberite: `consultation-prod`
4. VS Code bi trebalo da se poveže bez traženja šifre

## Korak 5: Klonirajte projekat lokalno

```bash
# U PowerShell ili Git Bash
cd D:/
git clone git@github.com:studiotrid/consultation.git consulting
cd consulting
code .
```

Gotovo! Sada imate:
- ✅ SSH pristup bez šifre sa Windows-a
- ✅ VS Code Remote-SSH bez šifre
- ✅ Git sinhronizaciju između lokala i produkcije
