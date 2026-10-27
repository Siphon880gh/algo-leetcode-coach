## Per distinct value

1. Count values; set zeros aside. `dp[0] = 1`.
2. For each value v with c copies: `new[s] = dp[s] + new[s − v] − dp[s − (c + 1)·v]` (terms with negative index are 0), mod 10^9 + 7.
3. Return `(zeros + 1) · Σ dp[l … r]`.

Examples → 1, 7, 9. Checked against listing every sub-multiset on 300 random inputs.

Equal values are not distinct choices: counting subsets of positions gives the first two examples → 2 and 9. Forgetting zeros gives [0, 0, 1] with l = 0, r = 1 → 2 instead of 6. The sum is at most 2 · 10^4, so there are at most 199 distinct non-zero values and about 4 · 10^6 steps.

Time: O(√S · S)  
Space: O(S)

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
