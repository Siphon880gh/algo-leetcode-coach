Given an array of distinct integers, return for each index the length of the longest subarray in which that element is the maximum. The limits are in the official statement. For instance, [1, 5, 4, 3, 6] → [1, 4, 2, 1, 5]. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Nearest greater

1. Decreasing stack: when a[i] is bigger than the top, the top’s right bound is i; after popping, the top (if any) is i’s left bound.
2. Missing bounds are −1 and n.
3. Answer `right − left − 1`.

Constructed checks (run in code): the example above; 300 random distinct arrays match testing every subarray.

Checking every subarray is O(n³), and expanding from each index is O(n²).

Time: O(n)  
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
