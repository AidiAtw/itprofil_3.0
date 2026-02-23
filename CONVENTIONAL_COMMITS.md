# Conventional Commits

## Typy commitů

### feat
Přidání **nové funkce** do projektu.

```bash
git commit -m "feat(php): přidat funkci pro načítání dat"
git commit -m "feat(profil): přidat nové pole do JSON"
```

### fix
Oprava **chyby** nebo problému.

```bash
git commit -m "fix(php): opravit duplikování projektů"
git commit -m "fix(css): opravit zarovnání textu"
```

### docs
Změny v **dokumentaci** (README, komentáře, návody).

```bash
git commit -m "docs: přidat návod na spuštění"
git commit -m "docs(readme): aktualizovat strukturu"
```

### style
Změny **vzhledu kódu** - formátování, odsazení, CSS (NE logika kódu).

```bash
git commit -m "style(css): vylepšit design"
git commit -m "style(html): přidat spacing"
```

### refactor
Přepsání kódu **bez změny chování** - optimalizace, přeorganizování.

```bash
git commit -m "refactor(php): extrahovat třídu ProfileLoader"
```

### chore
**Údržba** - aktualizace konfigurace, závislostí, build procesy.

```bash
git commit -m "chore: nastavit git template"
git commit -m "chore: aktualizovat .gitignore"
```