Given a 0/1 grid, count the axis-aligned rectangles whose four corners are all 1. Only the corners need to be 1, and the four corners must be distinct cells. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Choose two rows, then two columns

**Row pairs:** for every pair of rows, count `c` = the columns with 1 in both. They form `c · (c − 1) / 2` rectangles. O(m² · n).

**Column-pair counter:** scan the rows. For each row, list its 1-columns; for every pair `(c1, c2)` among them, add `count[(c1, c2)]` to the answer, then increment it. Each earlier row with the same pair closes a rectangle with this row. O(m · k²) for `k` ones per row, faster on sparse rows.

Pick based on density: the counter is better when rows have few ones.

Do not enumerate four corners directly; that is O(m² · n²). Do not count pairs with `c1 == c2`; a rectangle needs two distinct columns.

Time: O(m² · n) or O(m · k²)  
Space: O(1) or O(n²)

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
