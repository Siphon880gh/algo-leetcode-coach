## Exact, then case, then vowels

Preprocess:

- `exact = set(wordlist)`.
- `caps[w.lower()]` = the first `w` with that lowercase form.
- `vowels[devowel(w.lower())]` = the first `w` with that pattern, where `devowel` replaces each of `aeiou` with `*`.

For each query `q`:

1. If `q` is in `exact`, return `q`.
2. Else if `q.lower()` is in `caps`, return that word.
3. Else if `devowel(q.lower())` is in `vowels`, return that word.
4. Else return `""`.

Only store the first match when building `caps` and `vowels`; the rules ask for the first word in the list.

Do not check the rules in another order. Do not overwrite earlier entries with later words.

Time: O(total letters)  
Space: O(total letters)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
