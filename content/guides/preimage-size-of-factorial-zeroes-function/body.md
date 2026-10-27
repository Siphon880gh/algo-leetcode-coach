## Trailing zeros count factors of 5

`zeros(x) = x // 5 + x // 25 + x // 125 + …`. It is non-decreasing in `x`, and it only changes when `x` crosses a multiple of 5. So each value it takes is held by a block of exactly 5 consecutive numbers (`5m, …, 5m + 4`).

Some counts are skipped: at 25, the count jumps by 2. So the answer is either 5 or 0.

Binary search `x` in `[0, 5 · (k + 1)]` (because `zeros(5(k + 1)) ≥ k + 1`) for `zeros(x) == k`. Return 5 if found, else 0.

Equivalently, return `lower_bound(k + 1) − lower_bound(k)` where `lower_bound(t)` is the smallest `x` with `zeros(x) ≥ t`.

Do not compute factorials; `k` goes up to 10⁹. Do not scan `x` upward; binary search makes it O(log² k).

Time: O(log² k)  
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
