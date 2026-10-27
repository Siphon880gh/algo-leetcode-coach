## Count the distances

Take all six pairs of points and their **squared** distances (integers, so no floating point).

A square gives exactly two distinct values: the side `s` four times and the diagonal `2s` twice. So check:

- there are exactly two distinct values,
- the smaller one appears four times and is not 0,
- the larger appears twice.

Order does not matter, so you never need to know which point follows which.

Sorting the six values works too: `d[0] > 0`, `d[0] == d[3]`, `d[4] == d[5]`, `d[4] == 2 · d[0]`.

Do not allow a zero distance; duplicate points cannot form a square. Do not only check four equal sides; a rhombus has those too, and the diagonals are what rule it out.

Time: O(1)  
Space: O(1)

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
