## The next parent is always at the front

Constructor: BFS the tree and enqueue every node that is missing a left or right child, in level order.

`insert(v)`:

1. `p = queue.front`; create `node(v)`.
2. If `p.left` is empty, set it. Otherwise set `p.right` and pop `p` from the queue.
3. Enqueue `node` (it has two free slots).
4. Return `p.val`.

`get_root()` returns the stored root.

Completeness means the free slots fill left to right, level by level, which is exactly queue order.

An array of all nodes also works: the parent of index `i` is `(i − 1) // 2`.

Do not search the tree for a free slot on every insert; that is O(n). Do not pop the parent after filling only its left child.

Time: O(n) to build, O(1) per insert  
Space: O(n)

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
