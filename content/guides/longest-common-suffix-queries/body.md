## Best index per node

1. For each container word i, walk its letters from the end, creating nodes. At the root and every node passed, keep i if (length, index) beats the stored one.
2. For a query, walk from its last letter while the child exists; answer the stored index of the last node reached.

Examples → [1, 1, 1], [2, 0, 2]. Checked against comparing every pair directly on 500 random small cases.

The root matters: a query sharing no suffix (xyz in example 1) still gets the shortest word. Ties go to the shortest word before the earliest: keeping only the earliest index gives example 1 → [0, 0, 0].

Time: O(total length of all words)  
Space: O(total container length)

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
