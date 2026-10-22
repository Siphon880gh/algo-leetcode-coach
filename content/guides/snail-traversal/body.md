## Index arithmetic

1. If `rowsCount · colsCount ≠ this.length`, return `[]`.
2. For each `i`: `col = floor(i / rowsCount)`, `k = i mod rowsCount`; `row = k` if col is even, else `rowsCount − 1 − k`.
3. `out[row][col] = this[i]`; return `out`.

Examples → the 5 × 4 snail matrix, [[1,2,3,4]], []. Checked in Node.

Define it as a regular function on Array.prototype so this is the array. Build the rows first so each out[row] exists before writing into it.

Time: O(n)  
Space: O(n)

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
