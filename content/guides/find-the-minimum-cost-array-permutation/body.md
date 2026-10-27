## Fix 0, then DP

1. g(mask, last) = cheapest way to place the rest and close the cycle: |last − nums[0]| when mask is full, else min over unused x of |last − nums[x]| + g(mask ∪ {x}, x).
2. Start with [0]; at each step pick the smallest x matching g’s optimum.

Examples → [0, 1, 2], [0, 2, 1]. Checked against all permutations for n ≤ 7 (240 random cases).

States: 14 · 2^14; with 14 choices each, about 3.2 · 10^6 steps.

Time: O(n² 2^n)  
Space: O(n 2^n)

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
