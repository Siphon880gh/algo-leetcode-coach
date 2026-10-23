## Build

1. Search short chains of blocks whose path counts multiply to k and that fit in m × n (k = 1 is the empty chain).
2. Free those blocks, then the rest of the last block's bottom row and the last column below it. Block everything else.
3. Nothing fits → [].

Examples → 2 paths, 4 paths, []. Every m, n ≤ 10 and k ≤ 4 checked by counting paths; every [] answer checked by trying all grids with up to 16 cells (1 × n, n × 1 with k > 1; 2 × 2 with k ≥ 3; 2 × 3 and 3 × 2 with k = 4).

Using only one free rectangle: example 2 → [] instead of a 4-path grid.

Time: O(m · n)  
Space: O(m · n)

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
