## Two Sum on a tree

**Hash set:** DFS or BFS over the tree. At each node, if `k − node.val` is in `seen`, return true; otherwise add `node.val`. Return false at the end. This works for any binary tree.

**Using the BST order:** an in-order traversal gives the sorted values; then run two pointers from both ends as in Two Sum II (167). With two BST iterators (one forward, one backward), the extra space is O(h).

Do not pair a node with itself; check the set before adding the current value. Do not search the BST for `k − val` from the root at every node unless you exclude the node itself; it works, but costs O(n · h).

Time: O(n)  
Space: O(n), or O(h) with two iterators

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
