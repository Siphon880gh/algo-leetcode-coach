## Tetrahedral numbers

1. Largest `k` with `T(k) = k(k + 1)(k + 2) / 6 ≤ n`; floor so far `k(k + 1) / 2`.
2. `r = n − T(k)` boxes remain.
3. Smallest `j` with `j(j + 1) / 2 ≥ r`: each new floor box along the edge lets one more box stack on top of the previous ones.
4. Answer `k(k + 1) / 2 + j`.

`n = 3` → 3, `n = 4` → 3, `n = 10` → 6. Constructed: `n = 15` → k = 3 (10 boxes, floor 6), r = 5 → j = 3 → 9.

Do not assume the answer is always a triangular number; the leftover staircase handles partial layers.

Time: O(n^(1/3))  
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
