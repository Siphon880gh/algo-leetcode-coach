## Sorted order makes it a neighbor problem

In a sorted list, the closest pair is always adjacent. An inorder traversal of a BST gives sorted values, so keep `prev` (start as none) and update `ans = min(ans, v − prev)` at each node, then `prev = v`.

Iterative inorder with a stack works the same. Minimum Distance Between BST Nodes (783) is the identical problem.

Do not compare a node only with its children — in `[4,2,6,1,3]`, 3 and 4 differ by 1 but 3 is a grandchild of 4. The closest pair can be a node and a distant ancestor. Do not start `prev` at 0; the first value has nothing before it.

Time: O(n)  
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
