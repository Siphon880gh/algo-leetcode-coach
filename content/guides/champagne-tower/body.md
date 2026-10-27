## Flow, not time

The order of pouring does not matter, only the total that passes through each glass.

`row = [poured]`. For each row up to `query_row`:

- `next = [0] * (len(row) + 1)`.
- For each glass `j` with `excess = (row[j] − 1) / 2 > 0`: `next[j] += excess`, `next[j + 1] += excess`.
- `row = next`.

Return `min(1, row[query_glass])`; a glass can hold at most one cup even if more passed through it.

Do not simulate time steps; glasses at the edges fill more slowly and that only matters for timing, which the problem does not ask about. Do not cap amounts before passing the excess on; compute excess from the uncapped amount.

Time: O(query_row²)  
Space: O(query_row)

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
