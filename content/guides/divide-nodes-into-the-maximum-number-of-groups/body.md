## BFS from every node

1. Label components.
2. From each node, BFS; if an edge joins nodes whose levels do not differ by exactly 1, return −1. Record the number of levels for that node’s component, keeping the largest.
3. Return the sum over components.

Examples → 4, −1. Checked against trying every group assignment on 120 random graphs with up to 5 nodes.

An edge inside one BFS level means an odd cycle, which no grouping can satisfy. Starting from an end of the component’s longest shortest path spreads it over the most groups. With n ≤ 500 and m ≤ 10^4, n BFS runs cost about 5 · 10^6 steps.

Time: O(n · (n + m))  
Space: O(n + m)

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
