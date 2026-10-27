## Binomial sums

1. Sort nums; precompute binomials mod 10^9 + 7.
2. Answer Σ nums[i] · (Σ_{j<k} C(i, j) + Σ_{j<k} C(n − 1 − i, j)).

Examples → 24, 22, 12. Checked against every subsequence on 300 random arrays.

Counting only subsequences of exactly k elements: example 1 → 12 instead of 24.

Time: O(n log n + n · k), k ≤ 70  
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
