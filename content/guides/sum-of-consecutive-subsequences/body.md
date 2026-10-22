An array is consecutive if every step is +1, or every step is −1; a single element counts. Return the sum of the element sums of all consecutive subsequences (order kept, elements not necessarily adjacent), modulo the value the statement gives. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Two maps of (count, sum)

1. For x: (c, s) = up[x − 1]; new up ending here: count c + 1, sum s + c · x + x. Add both to up[x].
2. Same with down and x + 1.
3. ans += up_sum_here + down_sum_here − x (mod the given modulus).

Constructed checks (run in code): [1, 2, 3] → 20; [3, 2, 3] → 18; [2, 1, 2, 3] → 30. Checked against every subsequence on 300 random arrays.

Not subtracting the singletons: [1, 2, 3] → 26 instead of 20.

Time: O(n)  
Space: O(distinct values)

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
