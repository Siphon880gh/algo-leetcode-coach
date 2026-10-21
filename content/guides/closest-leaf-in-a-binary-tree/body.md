Given the root of a binary tree with unique values and a target value `k`, return the value of the leaf nearest to the node with value `k`, measured in edges. The path may go up through parents as well as down. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Moving up needs parent links

1. DFS once to record `parent[node]` and find the node `start` with value `k`.
2. BFS from `start` with a visited set. Neighbors are `left`, `right`, and `parent[node]`.
3. The first node dequeued with no children is the answer.

BFS explores in order of distance, so the first leaf found is the closest. The visited set stops BFS from bouncing back and forth between a node and its parent.

Alternative: for each ancestor of `start` at distance `d`, the closest leaf through it is `d` plus the closest leaf in its other subtree; precompute the closest leaf below every node. This is more complex for the same O(n).

Do not search only below `start`; the closest leaf may be through a parent. Do not treat the root as a leaf unless it has no children.

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
