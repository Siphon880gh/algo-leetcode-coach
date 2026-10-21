## Outer letters fixed

For each `c`: `i = first(c)`, `j = last(c)`; if `j − i > 1`, add `len(set(s[i + 1 : j]))`.

`"aabca"` → 3. `"adc"` → 0. `"bbcbaba"` → 4.

Widest outer pair gives the most middle choices, so first/last is enough. Prefix counts per letter make each middle-set query O(26).

Time: O(26 · n)  
Space: O(26)

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
