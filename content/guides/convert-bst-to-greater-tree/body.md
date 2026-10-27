BST with 0 to 1e4 nodes, unique values from −1e4 to 1e4. Change every node's value to the original value plus the sum of all larger values in the tree. Return the root. `[0,null,1]` → `[1,null,1]`. Example 1 turns 4 into 30 (4 + 5 + 6 + 7 + 8) and 8 stays 8.

## Visit from largest to smallest

Inorder goes left, node, right — ascending. Reverse it (right, node, left) and you go descending. Keep `s = 0`. At each node: `s += node.val`, then `node.val = s`. Everything visited earlier is larger, so `s` is exactly the node value plus all larger values.

Morris traversal does the same in O(1) extra space by threading the right-most path.

Binary Search Tree to Greater Sum Tree (1038) is the same problem.

Do not walk left first — that gives sums of the smaller values. Do not compute each node's sum separately; that is O(n²).

Time: O(n)  
Space: O(h) for recursion

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
