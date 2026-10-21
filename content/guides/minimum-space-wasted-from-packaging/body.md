## Cost per box size

1. Sort `packages`; prefix sums `P`.
2. For each supplier: sort boxes; skip if the largest box < largest package.
3. `i = 0`; for each size `b`: `j = bisect_right(packages, b)`; waste `+= b · (j − i) − (P[j] − P[i])`; `i = j`.
4. Minimum over suppliers, mod 1e9+7 at the end; none → −1.

Example 1 → 6. Example 2 → −1. Example 3 → 9.

Work is O(Σ boxes · log n) instead of n per supplier, which matters with 10^5 suppliers. Keep sums in 64-bit and apply the mod only after choosing the minimum.

Time: O(n log n + B log B + B log n), B = total boxes  
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
