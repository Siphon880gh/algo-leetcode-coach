You get the root of a binary tree. Visit the levels in zigzag order and return a list with one sum per level, where each level’s sum follows the statement’s rule for which nodes count. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## BFS

1. q = [root]; left = true.
2. Read q in order (left) or reversed; add each node’s value until one has no child on the reading side (left child when reading left to right, right child otherwise).
3. Append the sum, flip left, move to the next level.

Assumed here: the stopping rule above, and one sum per level.

Constructed checks (made-up trees, run in code): [1, 2, 3, 4, 5, null, 6] → [1, 5, 0]; [5, 3, 8, 1, null, 7, 9, null, null, 2] → [5, 8, 0, 0]. Checked against a DFS that groups levels on 2,000 random trees.

Reading every level left to right: the second check → [5, 11, 0, 0] instead of [5, 8, 0, 0].

Time: O(n)  
Space: O(n)

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
