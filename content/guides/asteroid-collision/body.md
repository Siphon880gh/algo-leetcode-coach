## Collisions happen at the top

For each asteroid `a`:

- `a > 0`: push it.
- `a < 0`: while the top is positive and smaller than `|a|`, pop it (it explodes).
  - If the top is positive and equal to `|a|`, pop it and drop `a` (both explode).
  - Else if the top is positive and larger, drop `a`.
  - Otherwise (empty stack or negative top), push `a`.

The stack, read bottom to top, is the final state.

Pairs moving apart (`−` then `+`) or in the same direction never meet, which is why only a positive top facing a negative newcomer is checked.

Do not compare sizes with signs; use `|a|`. Do not stop after one pop; a large left-mover can destroy several right-movers.

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
