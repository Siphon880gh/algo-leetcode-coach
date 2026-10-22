You get an integer n and an equilateral triangle of side n, cut into n² unit triangles arranged in n rows that grow longer toward the bottom. Two unit triangles are neighbours when they share a side. You colour some unit triangles red at the start; then, as long as some white triangle has at least two red neighbours, it turns red. Choose as few starting triangles as possible so that the whole triangle ends up red, and return them. The coordinate system and output format are in the official statement, and any optimal set is accepted. For instance, n = 1 needs its single triangle, and n = 2 needs 3 of its 4 triangles: the top one and the two outer triangles of the bottom row. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Bound, then construct

1. Lower bound, under the rule as restated above (a white triangle turns red once it has two red neighbours; the exact rule is in the official statement): a white triangle with r ≥ 2 red neighbours adds 3 sides and removes 2r from the red perimeter, a change of 3 − 2r ≤ −1. The start has perimeter at most 3k, the end has 3n, and there are n² − k steps, so 3k − (n² − k) ≥ 3n, that is k ≥ ⌈n(n + 3)/4⌉.
2. Construction: colour the top triangle. Then, from the bottom row upward, cycle through four row patterns: every upward-pointing triangle of the row; one downward-pointing triangle at the left end; every upward-pointing triangle except the leftmost; the leftmost triangle alone.
3. Output those triangles in the statement’s coordinates.

Constructed checks (simulated in code): the pattern turns the whole triangle red with exactly ⌈n(n + 3)/4⌉ triangles for every n up to 60, which gives 1, 3 and 5 for n = 1, 2, 3; trying every smaller set confirms the minimum for n ≤ 4.

Under the restated rule, the bound argument does not depend on the order of the spreading steps, so any set that meets it is optimal; the code confirms minimality directly only for n ≤ 4. If the official rule differs, redo the bound for it.

Time: O(n²)  
Space: O(1) besides the output

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
