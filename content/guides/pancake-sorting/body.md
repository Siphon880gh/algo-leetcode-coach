## Two flips per pancake

For `size = n, n − 1, …, 2`:

1. Find `i`, the index of value `size` (the array is a permutation of 1 to n).
2. If `i == size − 1`, it is already in place; continue.
3. If `i > 0`, flip the first `i + 1` (record `i + 1`), bringing it to the top.
4. Flip the first `size` (record `size`), sending it to position `size − 1`.

Return the recorded flips.

The result has at most `2n` flips, within the `10 · n` limit; the problem does not ask for the fewest.

Do not try to minimize the number of flips; that is NP-hard in general. Do not skip the `i == 0` check; flipping one pancake is a wasted move.

Time: O(n²)  
Space: O(n) for the answer

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
