## Match at ampersands

1. Entities: `&quot;` → `"`, `&apos;` → `'`, `&amp;` → `&`, `&gt;` → `>`, `&lt;` → `<`, `&frasl;` → `/`.
2. At each `&`, try each entity; on a match append the character and jump past it; otherwise copy `&`.

`"&amp;amp; is …"` → `"&amp; is …"` (decoded once). `"&quot;...&quot;"` → `"..."` in quotes.

Do not apply string replacements one after another; replacing `&amp;` first can create new entities such as `&gt;`. Do not decode recursively; each entity is replaced once.

Time: O(n)  
Space: O(n)

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
