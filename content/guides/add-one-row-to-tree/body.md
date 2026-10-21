## Insert between two levels

**Special case:** `depth == 1` → return a new node `val` with `left = root`.

Otherwise walk to the nodes at `depth − 1` (BFS level by level, or DFS with the current depth). For each such node `p`:

- `p.left = Node(val, left=p.left)`
- `p.right = Node(val, right=p.right)`

Every node at `depth − 1` gets both new children, even when an old child is missing; the new nodes just have a null subtree on that side.

Do not keep descending after inserting; the new row is complete once the `depth − 1` level is rewired. Do not attach the old right subtree under the new left node; left stays left and right stays right.

Time: O(n) in the worst case  
Space: O(width) for BFS, or O(h) for DFS

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
