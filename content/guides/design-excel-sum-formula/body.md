Design `Excel(height, width)` with columns `A` to the given letter and rows from 1. `set(row, column, val)` writes a number. `get(row, column)` returns the current value. `sum(row, column, numbers)` puts a live formula in the cell: the sum of every cell or range in `numbers` (like `"A1"` or `"A1:B2"`), and returns its value. A formula stays live, so later changes to the cells it uses change its value, until `set` overwrites it. There are no cycles. `set(1,"A",2)`, `sum(3,"C",["A1","A1:B2"])` → 4, then `set(2,"B",2)` makes `get(3,"C")` → 6. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Formulas as reference counts

Store for each cell either `value` or `formula: {cell: count}`.

- `sum(r, c, numbers)`: expand every entry (a range becomes all its cells) and count how many times each cell appears, so `"A1", "A1:B2"` counts A1 twice. Store that map as the cell's formula, then return `get(r, c)`.
- `get(r, c)`: if the cell has a formula, return `Σ count · get(ref)`; otherwise return its value.
- `set(r, c, v)`: drop any formula and store `v`.

Evaluating on demand keeps formulas live automatically. For heavy read traffic, store values and keep a reverse-dependency list, then push changes to dependents in topological order on each `set`.

Do not copy the referenced values into the cell when `sum` is called; later `set` calls must still show up. Do not count a cell once when it is listed twice; a repeated reference is added twice.

Time: `get` is O(size of the formula graph it touches); `set` is O(1)  
Space: O(cells + references)

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
