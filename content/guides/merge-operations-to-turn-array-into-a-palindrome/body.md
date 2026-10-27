You are given an array of positive integers. In one operation you may replace two adjacent elements with a single element equal to their sum. Return the fewest operations needed to make the array a palindrome. For instance, [1,2,3,1] → 1, [3,1,1,2,3] → 1 and [1,2,1] → 0. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Grow the smaller end

1. `i = 0`, `j = n − 1`, `L = a[i]`, `R = a[j]`, `ops = 0`.
2. While `i < j`: if `L = R`, move both in and reload `L` and `R`; if `L < R`, `i++`, `L += a[i]`, `ops++`; else `j−−`, `R += a[j]`, `ops++`.
3. Return `ops`.

Constructed checks (verified against a breadth-first search over every sequence of merges on 300 random small arrays): the cases above → 1, 1, 0.

Values are positive, so the outermost pieces of a palindrome must have equal sums, and the smaller end can only reach that by absorbing its neighbour. A single remaining element is already a palindrome.

Time: O(n)  
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
