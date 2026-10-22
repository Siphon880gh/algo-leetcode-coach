## Tree DP with 5 values

1. Process nodes in reverse BFS order; each node merges its cost with its children’s lists and keeps the 2 smallest and 3 largest.
2. Fewer than 3 nodes: coin = 1. Otherwise `max(0, top1·top2·top3, low1·low2·top1)`.

Examples → [120, 1, 1, 1, 1, 1], [280, 140, 32, 1, 1, 1, 1, 1, 1], [0, 1, 1]. Checked against trying every triple on 400 random trees.

The three largest are not always best: a star with costs [−5, −4, 1, 3] → 60 at the root, from (−5)·(−4)·3.

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
