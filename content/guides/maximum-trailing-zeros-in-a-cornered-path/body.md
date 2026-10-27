## Every corner, four shapes

1. Count factors 2 and 5 in each cell.
2. Row and column prefix sums of both counts.
3. For each cell `(i, j)`: arms left/right and up/down (excluding the cell); for each pair, `min(h2 + v2 + c2, h5 + v5 + c5)`.
4. Return the best.

Examples → 3, 0. Checked against every cornered path on 150 small grids.

Values are positive, so extending an arm never lowers either count, so each arm should run to the edge. A straight path is the case where one arm adds nothing beyond the other.

Time: O(m · n)  
Space: O(m · n)

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
