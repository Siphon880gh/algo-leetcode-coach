## Per-bit cost

For each bit `i` (x from a, y from b, z from c):
- `z = 0`: add `x + y`.
- `z = 1`: add 1 if `x = y = 0`.

`(2, 6, 5)` → 3. `(4, 2, 7)` → 1. `(1, 2, 3)` → 0.

Do not count a single flip when both bits are 1 and `c`'s bit is 0; both must flip. Do not XOR `a | b` with `c` and pop-count it; that misses the double flip.

Time: O(bits)  
Space: O(1)

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
