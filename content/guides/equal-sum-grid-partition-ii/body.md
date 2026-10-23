## Sweep with counts

1. Horizontal cuts: move row i from the bottom counts to the top counts; d = top − bottom.
2. d = 0 → true. Otherwise look for a cell worth |d| on the larger side:
   - side with ≥ 2 rows and ≥ 2 columns: any cell (hash count);
   - side that is one row: its first or last cell; one column: its top or bottom cell.
3. Transpose and repeat for vertical cuts.

Examples → true, true, false, false. Checked against trying every cut and every removed cell with a connectivity check on 1000 random grids.

Allowing any cell on a single-row side: example 3 → true instead of false.

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
