## DP

1. P = prefix sums; f_0 = 0 everywhere.
2. For j = 1 … m: f_j[i] = max(f_j[i − 1], P[i] + max over t in [i − r, i − l] of f_{j−1}[t] − P[t]), with −∞ when nothing fits.
3. Return max over j ≥ 1 of f_j[n].

Examples → 7, 8, 6, −1. Checked against a plain O(m · n · r) DP on 2,000 random arrays.

Forcing exactly m subarrays: example 4 → −4 instead of −1.

Time: O(m · n)  
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
