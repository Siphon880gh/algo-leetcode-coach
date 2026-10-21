Given an array of colors with values 1, 2, or 3 and queries `(i, c)`, return for each query the distance from index i to the nearest index with color c, or −1 if c does not appear. For instance, `colors = [2,1,3]` with queries `[[0,3],[1,2],[2,1]]` gives `[2,1,1]`, and `colors = [1,1]` with query `[[0,2]]` gives `[−1]`. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Two sweeps per color

1. `left[c][i]` = distance to the nearest `c` at or before `i` (∞ if none).
2. `right[c][i]` = distance to the nearest `c` at or after `i`.
3. Query `(i, c)`: `d = min(left[c][i], right[c][i])`; return −1 if `d` is ∞.

Binary searching each color's sorted index list also works, at O(log n) per query.

Do not scan outward per query; queries can be as many as the elements. Do not return 0 for a missing color.

Time: O(n + q)  
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
