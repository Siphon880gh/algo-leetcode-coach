The tree has 1 to 1e4 nodes. Its boundary is: the root; the left boundary (start at `root.left`; each step goes to the left child if there is one, else the right child; stop before a leaf); every leaf from left to right; and the right boundary in reverse (start at `root.right`; prefer the right child, else the left; stop before a leaf). The root is not a leaf. `[1,null,2,3,4]` → `[1,3,4,2]`. `[1,2,3,4,5,6,null,null,null,7,8,9,10]` → `[1,2,4,7,8,9,10,6,3]`. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Three separate walks

1. `ans = [root.val]` (if the root has any child; a lone root is just `[root.val]`).
2. Left boundary: `node = root.left`; while `node` is not a leaf, append it and move to `node.left or node.right`.
3. Leaves: DFS from the root, left before right, append nodes with no children (skip the root itself).
4. Right boundary: `node = root.right`; while not a leaf, collect it and move to `node.right or node.left`. Append the collection reversed.

Excluding leaves from both edges is what keeps each leaf from appearing twice.

Do not include the root in the leaves when it has no children — it is already first. Do not go right in the left boundary when a left child exists. Do not forget to reverse the right boundary.

Time: O(n)  
Space: O(h) plus the output

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
