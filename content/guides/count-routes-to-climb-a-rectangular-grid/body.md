## Two states per cell

1. up[c] = 1 for open cells of the bottom row.
2. For the current row: side[c] = Σ up[c′] over open c′ ≠ c with |c − c′| ≤ d.
3. Next row up: up[c] = Σ (up + side)[c′] with |c − c′| ≤ ⌊√(d² − 1)⌋, for open c.
4. At the top row, compute side once more; return Σ up + Σ side mod 10^9 + 7.

Examples → 2, 4, 0, 4. Checked against listing every route on 600 random small grids.

Using d as the column reach for up moves too: example 1 → 4 instead of 2.

Time: O(n · m)  
Space: O(m)

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
