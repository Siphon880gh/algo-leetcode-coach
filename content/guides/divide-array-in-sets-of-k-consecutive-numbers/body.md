## Start runs at the minimum

1. If `n mod k ≠ 0`, return false.
2. Count values; iterate distinct values in sorted order.
3. For `x` with `c = count[x] > 0`: for `y` in `x .. x + k − 1`, if `count[y] < c` return false, else `count[y] −= c`.
4. Return true.

`[1,2,3,3,4,4,5,6]`, k = 4 → true. `[3,2,1,2,3,4,3,4,5,9,10,11]`, k = 3 → true. `[1,2,3,4]`, k = 3 → false.

Do not start a group at an arbitrary value; only the minimum is forced. Do not subtract 1 per group in a loop when `c` is large; subtract `c` at once.

Time: O(n log n)  
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
