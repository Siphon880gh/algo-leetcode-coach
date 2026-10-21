## Try tops[0] and bottoms[0]

`check(x)`:

- `rotTop = rotBottom = 0`.
- For each `i`: if `tops[i] != x and bottoms[i] != x`, return −1 (impossible). Else if `tops[i] != x`, `rotTop += 1`; else if `bottoms[i] != x`, `rotBottom += 1`.
- Return `min(rotTop, rotBottom)`.

Answer: the smallest non-negative result of `check(tops[0])` and `check(bottoms[0])`, or −1 if both fail.

A domino showing x on both faces needs no rotation either way.

Do not try all values 1 to 6 unless you want to; only two can work. Do not count rotations for the two rows together; pick the cheaper row.

Time: O(n)  
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
