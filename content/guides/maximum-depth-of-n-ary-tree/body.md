## Recurse over the children list

`depth(null) = 0`. Otherwise `1 + max(depth(c) for c in children)`, using 0 when there are no children.

BFS works too: count how many levels you pop until the queue is empty.

Maximum Depth of Binary Tree (104) is the two-child version.

Do not call `max` on an empty list without a default — leaves have no children. Do not count edges; a single node has depth 1.

Time: O(n)  
Space: O(h) recursion, or O(width) for BFS

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
