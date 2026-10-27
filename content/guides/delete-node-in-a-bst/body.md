BST with 0 to 1e4 nodes and unique values. Delete the node whose value is `key` (if any) and return the root, which may change. Several shapes are accepted. `[5,3,6,2,4,null,7]`, key 3 → `[5,4,6,2,null,null,7]` (or `[5,2,6,null,4,null,7]`). Key 0 → unchanged. Empty tree → empty.

## Search, then three cases

Recurse: if `key < node.val`, set `node.left = delete(node.left, key)`; if larger, do the same on the right. Return `node`.

When `node.val == key`:

- No left child → return `node.right`.
- No right child → return `node.left`.
- Two children → find the successor `s`, the leftmost node of the right subtree. Copy `s.val` into `node`, then delete `s.val` from `node.right`. (Another accepted version hangs `node.left` under the successor and returns `node.right`, but that can make the tree taller.)

Insert into a Binary Search Tree (701) only ever adds a leaf. Trim a Binary Search Tree (669) removes whole ranges.

Do not forget to reattach the subtree that the recursive call returns. Do not pick any node from the right subtree — only its minimum keeps BST order.

Time: O(h)  
Space: O(h) recursion

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
