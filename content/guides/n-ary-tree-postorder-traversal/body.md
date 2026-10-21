## Node last

**Recursive:** recurse into each child from left to right, then append `node.val`.

**Iterative (the follow-up):** push the root. While the stack is not empty, pop a node, append its value, and push its children in **normal** order. That produces node, rightmost child, …, leftmost child, which is exactly postorder reversed. Reverse the list at the end.

A visited flag per stack entry (push the node back once with the flag set before its children) also works, without the final reverse.

N-ary Tree Preorder Traversal (589) is the node-first version.

Do not push the children in reverse here; with the final reverse that would put the rightmost child first. Do not forget the reverse; without it you get a mirrored preorder.

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
