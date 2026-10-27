You get an array nums of positive integers. One operation picks one element and either multiplies it by an integer k ≥ 2, or divides it by an integer k with 2 ≤ k < the element, when k divides it exactly. Return the fewest operations that make all elements equal. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Count related elements

1. All values equal → 0.
2. For each distinct value x, list its divisors d and add cnt[x] to mult[d] (how many elements d divides).
3. For each distinct v ≥ 2: related(v) = Σ cnt[d] over divisors d of v, plus mult[v], minus cnt[v] (counted twice). bad(v) = n − related(v).
4. Cost(v) = (n − cnt[v]) + bad(v). Return min(n, min Cost(v)).

T = 1 only works when every element is already 1, because division needs k < x and so never reaches 1.

Constructed checks (made-up values, run in code): [4, 8, 12] → 2; [3, 5, 7] → 3; [1, 1] → 0; [1, 2, 4] → 2. Matched trying every target up to 6000 with a two-step search on 300 random arrays.

Always multiplying everything to a common multiple: the first check → 3 instead of 2.

Time: O(D · (π(√V) + d(V))) for D distinct values up to V: factor with the primes up to √V (about 3,400), then walk the d(V) divisors  
Space: O(D · d(V)) for the mult map

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
