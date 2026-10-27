## Knapsack with a factor 2

1. f = [1, 0, …, 0] over sums 0 … k.
2. For each x: g[j] = 2·f[j] + (f[j − x] if j ≥ x), all mod 10^9 + 7; f = g.
3. Return f[k].

Examples → 6, 4, 0. Checked against listing every subsequence and its subsets on 300 random small arrays.

The factor 2 counts the outer subsequences: a plain subset-sum count gives example 1 → 2 instead of 6.

Time: O(n k)  
Space: O(k)

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
