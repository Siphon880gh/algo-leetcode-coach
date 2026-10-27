## Smallest value has no half

1. Odd length → `[]`.
2. `cnt` = counter. For `x` in sorted distinct values:
   - `x == 0`: need `cnt[0]` even; add `cnt[0] / 2` zeros.
   - else: need `cnt[2x] ≥ cnt[x]`; `cnt[2x] −= cnt[x]`; add `cnt[x]` copies of `x`.
3. Return the collected values.

Examples → `[1,3,4]`, `[]`, `[]`. Checked against trying every half on random small arrays.

The smallest remaining value cannot be anyone's double (its half would be smaller), so it must be an original. Going upward keeps that true at every step.

Time: O(n log n)  
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
