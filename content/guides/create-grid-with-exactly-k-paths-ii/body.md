You get an integer k. Build any grid of '.' (free) and '#' (blocked) cells, within the size limit in the official statement, that has exactly k paths from the top-left cell to the bottom-right cell moving only right or down through free cells. Return an empty list if no such grid exists. It extends Create Grid With Exactly K Paths I, where the grid size was fixed and k was tiny. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Build

1. L = highest set bit of k. Grid: 2L + 1 rows, L + 3 columns, all blocked.
2. Stage i < L: free (2i, i), (2i, i + 1), (2i + 1, i), (2i + 1, i + 1). Paths at (2i, i) = 2^i.
3. Bit i set (i < L): free row 2i from column i + 2 to the last column.
4. Free row 2L from column L to the end, and the whole last column.

Assumed here: the size limit is 25 × 25 and k is at most about 1000, so 2L + 1 ≤ 21 rows fit.

Path counts checked for every k from 1 to 2047. Constructed check (made-up value, run in code): k = 5 → [".....", "..##.", "#..#.", "#..#.", "##..."], which has 5 paths.

Looking for a single free rectangle with C(a + b − 2, a − 1) = k: constructed check (run in code) k = 1000 → no rectangle up to 25 × 25 fits.

Time: O(log² k)  
Space: O(log² k)

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
