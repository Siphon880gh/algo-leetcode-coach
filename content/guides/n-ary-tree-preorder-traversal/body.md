## Node first

**Recursive:** append `node.val`, then recurse into each child from left to right.

**Iterative (the follow-up):** push the root onto a stack. While the stack is not empty, pop a node, append its value, and push its children in **reverse** order. The leftmost child ends up on top, so it is visited next.

N-ary Tree Postorder Traversal (590) visits the children first; Binary Tree Preorder Traversal (144) is the two-child case.

Do not push the children in their normal order; the rightmost child would come out first. Do not use a queue; that gives level order, not preorder.

Time: O(n)  
Space: O(h) recursion, or O(n) stack in the worst case

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
