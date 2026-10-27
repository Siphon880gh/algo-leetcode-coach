## Two states

`keep, swap = 0, 1` for index 0. For each `i ≥ 1`, start `nk = ns = ∞`:

- If `a[i − 1] < a[i]` and `b[i − 1] < b[i]` (order already fine): `nk = min(nk, keep)`, `ns = min(ns, swap + 1)`. Both indexes keep, or both swap.
- If `a[i − 1] < b[i]` and `b[i − 1] < a[i]` (crossed order fine): `nk = min(nk, swap)`, `ns = min(ns, keep + 1)`. Exactly one of the two indexes swaps.

`keep, swap = nk, ns`. Return `min(keep, swap)`.

The input guarantees a solution exists, so at least one condition holds at every step. Often both hold, and the DP chooses.

Do not decide greedily at each index; whether to swap depends on what comes later. Do not swap the arrays for real; the DP only tracks costs.

Time: O(n)  
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
