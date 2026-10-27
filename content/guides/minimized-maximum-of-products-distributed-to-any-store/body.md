## Feasibility is monotone

1. `lo = 1`, `hi = max(quantities)`.
2. `fits(x) = Σ ceil(q / x) ≤ n`.
3. Binary search the smallest `x` with `fits(x)`.

Examples → 3, 5, 100000.

A larger cap never needs more stores, so the predicate is monotone. Stores may get 0 products, so using fewer than n stores is fine. `ceil(q / x) = (q + x − 1) // x`.

Time: O(m log max)  
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
