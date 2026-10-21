## Chains and placements

1. `f[v][1] = 1` for every `v`. For `k = 1 … 13`: add `f[v][k]` to `f[w][k + 1]` for each multiple `w = 2v, 3v, … ≤ maxValue`.
2. Return `Σ f[v][k] · C(n − 1, k − 1)` over all `v` and `k ≤ min(n, 14)`, modulo 10^9 + 7.

Examples → 10, 11. Checked against listing every array for n ≤ 5, maxValue ≤ 8.

Each strict step at least doubles the value, and 2^13 = 8192 ≤ 10^4 < 2^14, so a chain has at most 14 distinct values. An array of length n with k distinct values chooses which k − 1 of the n − 1 gaps change value. Precompute factorials for C modulo the prime.

Time: O(maxValue · log maxValue · 14)  
Space: O(maxValue · 14)

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
