## Turn the tree into an undirected graph

1. DFS from the root and store `parent[node]` for every node.
2. BFS from `target` with a `seen` set. Neighbors of a node are its left child, right child and parent.
3. Stop after `k` levels; the nodes in the queue are the answer.

If `k == 0`, the answer is `[target.val]`.

The `seen` set matters: without it, the BFS walks from a child to its parent and straight back.

Do not search only the target's subtree; nodes at distance `k` can be above it or in a sibling subtree. Do not compare nodes by value when building the map unless values are unique (they are here, but node references are safer).

Time: O(n)  
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
