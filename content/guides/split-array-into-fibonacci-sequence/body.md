## Two free choices

For each length of the first number `i` and the second `j`:

- Skip a part with a leading zero (unless it is exactly `"0"`) or a value above `2³¹ − 1`.
- Then repeatedly compute `next = a + b`, check that the string continues with exactly `str(next)`, and advance. Stop when the string is used up (success if there are at least 3 numbers) or the check fails.

General backtracking over every position also works, but only the first two choices are free; after that each step either matches or fails.

Do not accept sequences of fewer than 3 numbers. Do not allow parts like `"01"`. Watch the 32-bit limit; long strings can produce huge sums.

Time: O(n²) choices × O(n) check = O(n³)  
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
