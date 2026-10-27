## Reachability under a weight cap

1. Reverse every edge.
2. Check(W): BFS from 0 using reversed edges with weight ≤ W; true if every node is reached. Its BFS tree uses one original outgoing edge per node, and threshold ≥ 1.
3. Binary search W over the distinct weights; if none works, −1.

Examples → 1, −1, 2, −1. Checked against trying every edge subset on 400 random small graphs.

Searching from 0 along the original directions: example 1 → −1 instead of 1.

Time: O((n + m) log m)  
Space: O(n + m)

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
