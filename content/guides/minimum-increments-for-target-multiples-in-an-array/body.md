## Subsets of targets

1. L[sub] = lcm of the targets in sub.
2. dp[0] = 0. For each x: for each mask and each non-empty sub of the uncovered targets, new[mask | sub] = min(…, dp[mask] + (−x mod L[sub])).
3. Answer dp[all].

Examples → 1, 2, 0. Checked against trying every set of small increments on 150 random cases.

Covering each target separately with its own cheapest number: example 2 → 3 instead of 2.

Time: O(n · 3^t), t ≤ 4  
Space: O(2^t)

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
