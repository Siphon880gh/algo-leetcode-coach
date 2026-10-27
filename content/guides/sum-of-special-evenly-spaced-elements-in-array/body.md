Given an array nums and queries [x, y], answer each with the sum of nums[j] for every j ≥ x where j − x is divisible by y, modulo 1e9+7. For instance, with nums = [0,1,2,3,4,5,6,7], query [0,3] → 0 + 3 + 6 = 9 and [4,2] → 4 + 6 = 10. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Small steps precomputed, large steps walked

1. `B = ⌊√n⌋`.
2. `y ≥ B`: sum `nums[x], nums[x + y], …` directly (≤ n / B terms).
3. `y < B`: for each distinct small `y` among the queries, build `suf[i] = nums[i] + suf[i + y]` from the right and answer all its queries from it.

Constructed check on `[0,1,2,3,4,5,6,7]`: `[0,3]` → 9, `[5,1]` → 18, `[4,2]` → 10.

Total work O((n + q)·√n). Do not walk every query directly when y can be 1 (O(n · q)).

Time: O((n + q) · √n)  
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
