An array is hidden behind an interface that reports its length and the value at an index. Equal values form blocks of adjacent positions. Return the number of blocks. The exact interface, limits and any query budget are in the official statement. For instance, [1, 1, 1, 3, 9, 9, 9, 2, 10, 10] → 5. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Jump block by block

This assumes each value’s occurrences are all adjacent, so “equals a[i]” is true then false from i onward.

1. i = 0, count = 0.
2. While i < n: binary search the last j with `a[j] = a[i]`; count += 1; i = j + 1.
3. Return count.

Constructed checks (run in code): the example above; [7] → 1; [3, 3, 3, 3] → 1; 500 random block arrays match their number of distinct values.

Reading every position also works but uses n reads; this uses about k · log n for k blocks.

Time: O(k log n)  
Space: O(1)

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
