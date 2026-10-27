## Same tree, tried at each node

`same(a, b)`: both null → true; one null → false; otherwise `a.val == b.val and same(a.left, b.left) and same(a.right, b.right)`.

`isSubtree(root, sub)`: if `root` is null, return false. Otherwise return `same(root, sub) or isSubtree(root.left, sub) or isSubtree(root.right, sub)`.

That is O(m · n) in the worst case. For linear time, serialize both trees in preorder with explicit null markers and a separator in front of each value (`,3,4,1,#,#,2,#,#,5,#,#`), then run KMP. The separator stops `12` from matching `2`.

Same Tree (100) is the helper on its own.

Do not stop when the root values match but the trees differ; keep searching the children. Do not compare only the shape or only the values; a subtree must match both and end at the leaves.

Time: O(m · n), or O(m + n) with serialization and KMP  
Space: O(h)

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
