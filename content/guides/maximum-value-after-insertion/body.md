## Scan once

1. Positive `n`: first `i` with `n[i] < x` → insert there.
2. Negative `n`: from index 1, first `i` with `n[i] > x` → insert there.
3. No such position → append `x`.

`"99", 9` → `"999"`. `"-13", 2` → `"-123"`. `"73", 6` → `"763"`. `"-55", 2` → `"-255"`.

For a negative number you want the smallest magnitude, so the comparison flips. Never insert before the `-`.

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
