You are given an array of integers, each at least 2. Split it into contiguous subarrays so that the GCD of every subarray is greater than 1, and return the fewest subarrays needed. For instance, [12,6,3,14,8] → 2 and [4,12,6,14] → 1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Greedy cuts

1. `pieces = 1`, `g = 0`.
2. For each `x`: `g = gcd(g, x)`; if `g = 1`, `pieces++` and `g = x`.
3. Return `pieces`.

Constructed checks (verified against a DP over every split on 300 random arrays): the cases above → 2, 1; [2,3,5] → 3.

The GCD only falls as a piece grows, so once it hits 1 the piece must end before that number. Every single number is at least 2, so a new piece always starts valid.

Time: O(n log V)  
Space: O(1)

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
