## Even gaps

1. `words = text.split()`, `s = text.count(' ')`.
2. If one word: `word + ' ' * s`.
3. Else `q, r = divmod(s, w − 1)`; join with `q` spaces and append `r` spaces.

`"  this   is  a sentence "` (9 spaces, 4 words) → `"this   is   a   sentence"`. `" practice   makes   perfect"` (7 spaces) → three between, one trailing. `" hello"` → `"hello "`.

Do not divide by `w − 1` when there is only one word. The output length equals the input length.

Time: O(n)  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
