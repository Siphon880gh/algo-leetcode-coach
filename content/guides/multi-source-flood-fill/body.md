## BFS by levels

1. Color the sources; frontier = sources; dist = 0 there.
2. For each frontier cell and neighbor: unseen → dist = t + 1, take the color, add to the next frontier. Already at dist t + 1 → color = max.
3. Repeat until the frontier is empty.

Examples → [[1, 1, 2], [1, 2, 2], [2, 2, 2]], [[3, 3, 3], [5, 5, 5], [5, 5, 5]], [[5, 5], [5, 5]]. Checked against step-by-step spreading on 1,500 random grids.

Keeping the first color to arrive: example 1 → [[1, 1, 1], [1, 1, 2], [1, 2, 2]].

Time: O(n · m)  
Space: O(n · m)

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
