## Appending only touches the right edge

`insert(root, val)`:

- If `root` is null or `val > root.val`: return `Node(val, left = root)`.
- Otherwise `root.right = insert(root.right, val)` and return `root`.

Why: in the maximum tree, the new last element is to the right of everything. If it is the largest, it becomes the root with the whole old array on its left. Otherwise the root stays, and the new element joins the right part, so recurse right.

Do not rebuild the array and the tree; that is O(n) extra work, though it is also correct. Do not insert into the left subtree; the new value is the last element.

Time: O(h)  
Space: O(h) recursive, O(1) iterative

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
