## Bucket by quotient

1. `cnt[v]` = occurrences; `pre` = prefix sums of `cnt`.
2. For each `y` with `cnt[y] > 0`, for `k = 1 … M // y`: add `cnt[y] · k · (pre[min(M, (k + 1)y − 1)] − pre[ky − 1])`.
3. Return the total mod 1e9+7.

`[2,5,9]` → 10. `[7] × 7` → 49. Checked against brute force on random arrays.

Iterating only distinct `y` keeps the work at `M/1 + M/2 + … = O(M log M)`. Duplicates are handled by multiplying by `cnt[y]`.

Time: O(n + M log M)  
Space: O(M)

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
