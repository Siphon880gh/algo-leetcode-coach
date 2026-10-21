## Two flags per number

For each `x` from 1 to `n`, scan its digits:

- Any of `3, 4, 7` → not good.
- Otherwise it is good if at least one digit is in `{2, 5, 6, 9}`.

With `n ≤ 10⁴`, this is fast.

**DP for large n:** `state[x]` = 0 (invalid), 1 (valid but unchanged), 2 (valid and changed), computed from `state[x // 10]` and the last digit. Count the `x` with state 2. A digit DP over the decimal string handles any size.

Do not count numbers made only of `0, 1, 8`; they rotate to themselves. Do not forget that 2 and 5 swap with each other and 6 and 9 do too; all four count as changing.

Time: O(n log n), or O(n) with the DP  
Space: O(1), or O(n) with the DP

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
