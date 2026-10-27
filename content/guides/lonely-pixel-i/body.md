`picture` is `m` by `n` (up to 500 each) of `'B'` and `'W'`. A black lonely pixel is a `'B'` whose row and column contain no other `'B'`. Count them. `[["W","W","B"],["W","B","W"],["B","W","W"]]` → 3. `[["B","B","B"],["B","B","W"],["B","B","B"]]` → 0. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Two passes with counters

Pass 1: for each `'B'` at `(i, j)`, increment `rows[i]` and `cols[j]`. Pass 2: count cells with `'B'`, `rows[i] == 1`, and `cols[j] == 1`.

A slightly faster pass 2: for each row with `rows[i] == 1`, find its single `'B'` column `j` and check `cols[j] == 1`.

Lonely Pixel II (533) changes "exactly one" to "exactly target" and adds a matching-rows rule.

Do not check only the row or only the column. Do not count per pixel by rescanning its row and column — that is O(m n (m + n)).

Time: O(m n)  
Space: O(m + n)

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
