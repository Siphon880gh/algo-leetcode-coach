## Per diagonal

1. Collect values by d = i − j in row order.
2. d ≥ 0: sort descending; d < 0: sort ascending.
3. Write each diagonal back in row order.

Examples → [[8, 2, 3], [9, 6, 7], [4, 5, 1]], [[2, 1], [1, 0]], [[1]].

Sorting every diagonal descending: example 1 → [[8, 7, 3], [9, 6, 2], [4, 5, 1]].

Time: O(n² log n)  
Space: O(n²)

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
