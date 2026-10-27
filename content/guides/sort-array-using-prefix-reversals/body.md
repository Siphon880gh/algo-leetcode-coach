You get a permutation nums of 0 … n − 1 and a list pre of allowed lengths. One operation picks a length x from pre and reverses the first x elements of nums. Return the fewest operations that sort nums in increasing order, or −1 if it cannot be sorted. n is very small. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## BFS

1. Start from nums; the goal is the sorted permutation.
2. Neighbours: reverse the first x elements for each x in pre.
3. Return the distance when the goal is popped, else −1.

Assumed here: n is at most about 8, so there are at most 8! = 40,320 states.

Constructed checks (made-up values, run in code): nums = [1, 2, 0], pre = [1, 3, 2] → 2; nums = [1, 0, 2, 3, 4, 5, 6, 7], pre = [8, 7] → −1. Each n = 8 search finishes in well under a second.

Greedily taking the move that fixes the most positions: the first check → 4 instead of 2.

Time: O(n! · |pre| · n)  
Space: O(n! · n)

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
