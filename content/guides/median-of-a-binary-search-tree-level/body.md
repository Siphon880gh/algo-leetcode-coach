You get the root of a binary search tree and a level number, with the root at level 0. Return the median of the values on that level, taking the larger of the two middle values when the count is even, or −1 if the level has no nodes. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## BFS to the level

1. BFS from the root, tracking depth.
2. vals = values at depth level; if empty, return −1.
3. Sort vals; return vals[⌊|vals| / 2⌋].

An in-order walk gives the same values already sorted, since the tree is a BST.

Constructed checks (made-up trees, run in code): [20, 10, 30, 5, 15, 25, 40] → 30 at level 1, 25 at level 2, −1 at level 3; [9, 4, 12, null, 6] → 6 at level 2. Checked against the in-order walk on 1,500 random BSTs.

Taking the lower middle: the first tree at level 2 → 15 instead of 25.

Time: O(n log n)  
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
