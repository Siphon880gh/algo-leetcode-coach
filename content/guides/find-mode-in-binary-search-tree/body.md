BST with 1 to 1e4 nodes, values −1e5 to 1e5, where left subtrees hold values `<=` the node and right subtrees `>=`. Return every value that appears the most times, in any order. `[1,null,2,2]` → `[2]`. `[0]` → `[0]`. Follow-up: no extra space besides the recursion stack.

## Runs in sorted order

Inorder traversal of a BST lists values in non-decreasing order, so copies of one value are consecutive. Keep `prev`, `cnt` (length of the current run), `best` (largest run so far), and `ans`.

On each visited value `v`: if `v == prev`, `cnt += 1`; else `cnt = 1` and `prev = v`. If `cnt > best`, set `best = cnt` and `ans = [v]`. Else if `cnt == best`, append `v`.

A hash map of counts works for any tree but uses O(n) extra space. Morris traversal gives truly O(1) space if the recursion stack must count too.

Validate Binary Search Tree (98) and Minimum Absolute Difference in BST (530) also lean on inorder order. Most Frequent Subtree Sum (508) counts sums, not values.

Do not compare only with the parent — duplicates can be in different subtrees and still be adjacent in inorder. Do not forget to reset `ans` when a new best appears.

Time: O(n)  
Space: O(h) recursion (O(1) with Morris)

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
