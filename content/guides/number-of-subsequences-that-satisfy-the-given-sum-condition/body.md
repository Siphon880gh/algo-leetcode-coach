## Fix the minimum

1. Sort; precompute powers of 2 mod 1e9+7.
2. `l = 0`, `r = n − 1`: if `a[l] + a[r] ≤ target`, add `2^(r − l)` and `l += 1`; else `r −= 1`.

`[3,5,6,7]`, 9 → 4. `[3,3,6,8]`, 10 → 6. `[2,3,3,4,6,7]`, 12 → 61.

Do not compute `2^(r−l)` with floating pow; use a precomputed modular table. Sorting is safe because subsequences are counted as index sets.

Time: O(n log n)  
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
