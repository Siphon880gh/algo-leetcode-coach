You get n sheets in a row and m colors, where color i may cover at most limit[i] sheets. Paint every sheet using exactly two different colors, each forming one contiguous block. Count the ways modulo 10^9 + 7; two ways differ when some sheet gets a different color. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Sorted caps

1. c = sorted(min(limit[i], n − 1)); P = prefix sums.
2. For each i: find the first j with c_j ≥ n − c_i; add (sum of those c_j) + count · (c_i − n + 1).
3. Remove the pair of i with itself when it was counted; return the total mod 10^9 + 7.

Assumed here: both colors cover at least one sheet, and (i, j) and (j, i) are different ways because the sheets get different colors.

Constructed checks (made-up values, run in code): n = 5, limit = [4, 2, 3] → 12; n = 2, limit = [1, 1] → 2; n = 3, limit = [1, 1] → 0. Checked against counting every split on 3,000 random cases.

Counting each color pair once, unordered: the first check → 6 instead of 12.

Time: O(m log m)  
Space: O(m)

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
