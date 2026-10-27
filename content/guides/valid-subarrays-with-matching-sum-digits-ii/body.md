You get an array nums of positive integers and a digit x. A subarray is valid when the first digit and the last digit of its sum both equal x. Return the number of valid subarrays. It is the same task as Valid Subarrays With Matching Sum Digits I with a much longer array. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Ranges

1. P = prefix sums; cnt[r][i] = how many of P[0 … i − 1] are ≡ r mod 10.
2. For each j and each power p = 10^d with x · p ≤ P[j]: left ends i < j with P[j] − P[i] in [x · p, (x + 1) · p − 1] form a range found by binary search.
3. Add the left ends in that range with P[i] ≡ P[j] − x (mod 10).

Assumed here, as in part I: every value is positive.

Part I's examples → 4, 0. Constructed checks (made-up values, run in code): [3, 8, 10, 2], x = 1 → 1; [5, 15, 45, 5], x = 5 → 2. Checked against the O(n²) count on 1,500 random arrays.

Checking only the last digit: the second check → 6 instead of 2.

Time: O(n · D · log n), D ≤ 15 digit lengths  
Space: O(10 · n)

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
